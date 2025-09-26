<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementDoctype;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return DoctypeResource::collection($this->collection);
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
                'combos' => ProcurementDoctype::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementDoctype::mapFilters(),

                /** the table header */
                'headers' => ProcurementDoctype::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementDoctype::getPageIcon('procurement-doctype'),

                /** the record key */
                'key' => ProcurementDoctype::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementDoctype::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementDoctype::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementDoctype::getPageTitle($request, 'procurement-doctype'),

                /** the usetrash flag */
                'usetrash' => ProcurementDoctype::hasSoftDeleted(),
            ]
        ];
    }
}
