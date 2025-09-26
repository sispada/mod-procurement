<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementType;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return TypeResource::collection($this->collection);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request): array
    {
        if ($request->has('initialized')) {
            return [];
        }

        return [
            'setups' => [
                /** the page combo */
                'combos' => ProcurementType::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementType::mapFilters(),

                /** the table header */
                'headers' => ProcurementType::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementType::getPageIcon('procurement-type'),

                /** the record key */
                'key' => ProcurementType::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementType::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementType::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementType::getPageTitle($request, 'procurement-type'),

                /** the usetrash flag */
                'usetrash' => ProcurementType::hasSoftDeleted(),
            ]
        ];
    }
}
