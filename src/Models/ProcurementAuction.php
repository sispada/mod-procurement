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
            'types' => ProcurementType::forCombo('name AS title', 'id AS value', 'min'),
            'methods' => ProcurementMethod::forCombo(),
            'officers' => ProcurementBiodata::where('role', 'PPBJ')->forCombo(),
            'workgroups' => ProcurementWorkgroup::forCombo(),
            'workunits' => optional($request->user()->userable)->workunit_id ? ProcurementWorkunit::where('id', $request->user()->userable->workunit_id)->forCombo() : []
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
            ['title' => 'Mode', 'value' => 'mode'],
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
            'mode' => $model->mode,
            'type_id' => $model->type_id,
            'method_id' => $model->method_id,
            'month' => $model->month,
            'year' => $model->year,
            'source' => $model->source,
            'ceiling' => floatval($model->ceiling),
            'ceiling_formatted' => 'Rp. ' . number_format($model->ceiling, 0, ',', '.'),
            'officer_id' => $model->officer_id,
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
            'mode' => $model->mode,
            'type_id' => $model->type_id,
            'method_id' => $model->method_id,
            'month' => $model->month,
            'year' => $model->year,
            'source' => $model->source,
            'ceiling' => floatval($model->ceiling),
            'ceiling_formatted' => 'Rp. ' . number_format($model->ceiling, 0, ',', '.'),
            'officer_id' => $model->officer_id,
            'workunit' => [
                'title' => $model->workunit_name,
                'value' => $model->workunit_id
            ],
            'workunit_id' => $model->workunit_id,
            'workunit_name' => $model->workunit_name,
            'status' => $model->status,
            'documents' => $model->documents
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
            'canCreate' => false,
            'canEdit' => false,
            'canUpdate' => false,
            'canDelete' => false,
            'canRestore' => false,
            'canDestroy' => false,

            'isKABAG' => $request->user()->hasLicenseAs('procurement-kabag'),
            'isKASUBAG' => $request->user()->hasLicenseAs('procurement-kasubag'),
            'isPOKJA' => $request->user()->hasLicenseAs('procurement-ppbj'),
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
            $query->whereNotIn('status', ['DRAFTED', 'COMPLETED', 'ABORTED']);
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
        if ($user->hasLicenseAs('procurement-kasubag')) {
            return $query->where('status', 'SUBMITTED');
        }

        if ($user->hasLicenseAs('procurement-kabag')) {
            return $query->where('status', 'QUALIFIED');
        }

        if ($user->hasLicenseAs('procurement-ppbj')) {
            return $query->where('status', 'VERIFIED');
        }

        return $query;
    }

    /**
     * qualifiedRecord function
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function qualifiedRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->status = 'QUALIFIED';
            $model->qualified_by = $request->user()->userable_id;
            $model->save();

            DB::connection($model->connection)->commit();

            return response()->json([
                'success' => true,
                'message' => 'pemeriksaan qualifikasi berhasil.'
            ], 200);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * rejectedRecord function
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function rejectedRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->status = 'REJECTED';
            $model->rejected_by = $request->user()->userable_id;
            $model->save();

            DB::connection($model->connection)->commit();

            return response()->json([
                'success' => true,
                'message' => 'penolakan qualifikasi berhasil.'
            ], 200);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * verifiedRecord function
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function verifiedRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->workgroup_id = $request->workgroup_id;
            $model->status = 'VERIFIED';
            $model->verified_by = $request->user()->userable_id;
            $model->save();

            DB::connection($model->connection)->commit();

            return response()->json([
                'success' => true,
                'message' => 'verifikasi pengajuan berhasil.'
            ], 200);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * abortedRecord function
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function abortedRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->status = 'ABORTED';
            $model->aborted_by = $request->user()->userable_id;
            $model->save();

            DB::connection($model->connection)->commit();

            return response()->json([
                'success' => true,
                'message' => 'pembatalan pengajuan berhasil.'
            ], 200);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * avaluatedRecord function
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function avaluatedRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->status = 'COMPLETED';
            $model->evaluated_by = $request->user()->userable_id;
            $model->save();

            DB::connection($model->connection)->commit();

            return response()->json([
                'success' => true,
                'message' => 'evaluasi lelang berhasil.'
            ], 200);
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
