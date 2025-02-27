<?php

namespace Module\Procurement\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Procurement\Http\Resources\AuctionResource;

class ProcurementAuction extends Model
{
    use Filterable;
    use HasMeta;
    use HasPageSetup;
    use Searchable;
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'platform';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'procurement_auctions';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['procurement-auction'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'documents' => 'array',
        'meta' => 'array',
        'reports' => 'array',
    ];

    /**
     * The default key for the order.
     *
     * @var string
     */
    protected $defaultOrder = 'name';

    /**
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request): array
    {
        return [
            'workunits' => ProcurementWorkunit::forCombo()
        ];
    }

    /**
     * mapHeaders function
     *
     * readonly value?: SelectItemKey<any>
     * readonly title?: string | undefined
     * readonly align?: 'start' | 'end' | 'center' | undefined
     * readonly width?: string | number | undefined
     * readonly minWidth?: string | undefined
     * readonly maxWidth?: string | undefined
     * readonly nowrap?: boolean | undefined
     * readonly sortable?: boolean | undefined
     *
     * @param Request $request
     * @return array
     */
    public static function mapHeaders(Request $request): array
    {
        return [
            ['title' => 'Name', 'value' => 'name'],
            ['title' => 'Pagu', 'value' => 'ceiling'],
            ['title' => 'Unit Kerja', 'value' => 'workunit_name'],
            ['title' => 'Status', 'value' => 'status', 'sortable' => false, 'width' => '170'],
        ];
    }

    /**
     * mapResource function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResource(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'type' => $model->type,
            'method' => $model->method,
            'month' => $model->month,
            'year' => $model->year,
            'source' => $model->source,
            'ceiling' => 'Rp. ' . number_format($model->ceiling, 0, ',', '.'),
            'workunit' => [
                'title' => $model->workunit_name,
                'value' => $model->workunit_id
            ],
            'workunit_name' => $model->workunit_name,
            'status' => $model->status,

            'subtitle' => (string) $model->updated_at,
            'updated_at' => (string) $model->updated_at,
        ];
    }

    /**
     * mapResource function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResourceShow(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'type' => $model->type,
            'method' => $model->method,
            'month' => $model->month,
            'year' => $model->year,
            'source' => $model->source,
            'ceiling' => $model->ceiling,
            'workunit' => [
                'title' => $model->workunit_name,
                'value' => $model->workunit_id
            ],
            'workunit_name' => $model->workunit_name,
            'status' => $model->status,
        ];
    }

    /**
     * mapStatuses function
     *
     * @param Request $request
     * @return array
     */
    public static function mapStatuses(Request $request, $model = null): array
    {
        return [
            'canCreate' => $request->user()->hasLicenseAs('procurement-ppk'),
            'canEdit' => $request->user()->hasLicenseAs('procurement-ppk'),
            'canUpdate' => $request->user()->hasLicenseAs('procurement-ppk'),
            'canDelete' => $request->user()->hasLicenseAs('procurement-ppk'),
            'canRestore' => $request->user()->hasLicenseAs('procurement-ppk'),
            'canDestroy' => $request->user()->hasLicenseAs('procurement-ppk'),
        ];
    }

    /**
     * booted function
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('onlyProcessed', function (Builder $query) {
            $query->whereNotIn('status', ['COMPLETED', 'ABORTED']);
        });
    }

    /**
     * scopeForCurrentUser function
     *
     * @param Builder $query
     * @param [type] $user
     * @return void
     */
    public function scopeForCurrentUser(Builder $query, $user)
    {
        if ($user->hasLicenseAs('procurement-ppk')) {
            return $query->where('workunit_id', $user->userable->workunit_id);
        }

        if ($user->hasLicenseAs('procurement-pokja')) {
            return $query->whereIn('status', ['SIGNED', 'SHIFTED', 'EVALUATED', 'CONFIRMED', 'REPORTED']);
        }

        return $query;
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecord(Request $request)
    {
        $model = new static();

        DB::connection($model->connection)->beginTransaction();

        try {
            $model->name = $request->name;
            $model->slug = sha1(str($request->name)->slug());
            $model->type = $request->type;
            $model->method = $request->method;
            $model->month = $request->month;
            $model->year = $request->year;
            $model->source = $request->source;
            $model->ceiling = $request->ceiling;
            $model->workunit_id = $request->workunit['value'];
            $model->workunit_name = $request->workunit['title'];
            $model->status = 'DRAFTED';
            $model->submitted_by = $request->user()->userable_id;
            $model->save();

            DB::connection($model->connection)->commit();

            return new AuctionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model update method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->name = $request->name;
            $model->type = $request->type;
            $model->method = $request->method;
            $model->month = $request->month;
            $model->year = $request->year;
            $model->source = $request->source;
            $model->ceiling = $request->ceiling;
            $model->workunit_id = $request->workunit['value'];
            $model->workunit_name = $request->workunit['title'];
            $model->save();

            DB::connection($model->connection)->commit();

            return new AuctionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model delete method
     *
     * @param [type] $model
     * @return void
     */
    public static function deleteRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->delete();

            DB::connection($model->connection)->commit();

            return new AuctionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model restore method
     *
     * @param [type] $model
     * @return void
     */
    public static function restoreRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->restore();

            DB::connection($model->connection)->commit();

            return new AuctionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model destroy method
     *
     * @param [type] $model
     * @return void
     */
    public static function destroyRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->forceDelete();

            DB::connection($model->connection)->commit();

            return new AuctionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
