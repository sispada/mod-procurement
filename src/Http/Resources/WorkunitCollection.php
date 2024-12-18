<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementWorkunit;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkunitCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return WorkunitResource::collection($this->collection);
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
                'combos' => ProcurementWorkunit::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementWorkunit::mapFilters(),

                /** the table header */
                'headers' => ProcurementWorkunit::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementWorkunit::getPageIcon('procurement-workunit'),

                /** the record key */
                'key' => ProcurementWorkunit::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementWorkunit::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementWorkunit::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementWorkunit::getPageTitle($request, 'procurement-workunit'),

                /** the usetrash flag */
                'usetrash' => ProcurementWorkunit::hasSoftDeleted(),
            ]
        ];
    }
}
