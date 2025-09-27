<?php

namespace Module\Procurement\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Module\Procurement\Http\Resources\TypeResource;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class ProcurementType extends Model
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
    protected $table = 'procurement_types';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['procurement-type'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'meta' => 'array'
    ];

    /**
     * The default key for the order.
     *
     * @var string
     */
    protected $defaultOrder = 'name';

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

            'subtitle' => (string) $model->updated_at,
            'updated_at' => (string) $model->updated_at,
        ];
    }

    /**
     * mapResourceShow function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResourceShow(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'headers' => [
                ['title' => 'Name', 'key' => 'title', 'sortable' => false],
                ['title' => 'Mime', 'key' => 'mime', 'sortable' => false],
                ['title' => 'Maxsize', 'key' => 'maxsize', 'sortable' => false],
            ],
            'selected' => $selecteds = $model->doctypes()->pluck('document_id')->toArray(),
            'items' => $documents = ProcurementDocument::forCombo('name AS title', 'id AS value', 'mime', 'maxsize'),
            'documents' => static::mapDocuments($documents, $selecteds)
        ];
    }

    /**
     * mapDocuments function
     *
     * @param [type] $documents
     * @param [type] $selecteds
     * @return array
     */
    protected static function mapDocuments(Collection $documents, array $selecteds): array
    {
        return $documents->reduce(function ($carry, $document) use ($selecteds) {
            if (in_array($document->value, $selecteds)) {
                array_push($carry, $document);
            }

            return $carry;
        }, []);
    }

    /**
     * BelongsToMany function
     *
     * @return BelongsToMany
     */
    public function doctypes(): BelongsToMany
    {
        return $this->belongsToMany(ProcurementDocument::class, 'procurement_doctypes', 'type_id', 'document_id')->withTimestamps();
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
            $model->doctypes()->sync($request->selected);
            $model->save();

            DB::connection($model->connection)->commit();

            return new TypeResource($model);
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
            $model->doctypes()->sync($request->selected);
            $model->save();

            DB::connection($model->connection)->commit();

            return new TypeResource($model);
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

            return new TypeResource($model);
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

            return new TypeResource($model);
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

            return new TypeResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
