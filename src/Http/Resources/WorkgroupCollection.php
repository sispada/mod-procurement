<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementWorkgroup;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkgroupCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return WorkgroupResource::collection($this->collection);
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
                'combos' => ProcurementWorkgroup::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementWorkgroup::mapFilters(),

                /** the table header */
                'headers' => ProcurementWorkgroup::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementWorkgroup::getPageIcon('procurement-workgroup'),

                /** the record key */
                'key' => ProcurementWorkgroup::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementWorkgroup::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementWorkgroup::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementWorkgroup::getPageTitle($request, 'procurement-workgroup'),

                /** the usetrash flag */
                'usetrash' => ProcurementWorkgroup::hasSoftDeleted(),
            ]
        ];
    }
}
