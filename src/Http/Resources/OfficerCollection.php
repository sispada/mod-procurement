<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementOfficer;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OfficerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return OfficerResource::collection($this->collection);
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
                'combos' => ProcurementOfficer::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementOfficer::mapFilters(),

                /** the table header */
                'headers' => ProcurementOfficer::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementOfficer::getPageIcon('procurement-officer'),

                /** the record key */
                'key' => ProcurementOfficer::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementOfficer::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementOfficer::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementOfficer::getPageTitle($request, 'procurement-officer'),

                /** the usetrash flag */
                'usetrash' => ProcurementOfficer::hasSoftDeleted(),
            ]
        ];
    }
}
