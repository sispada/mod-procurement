<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementHistory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HistoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return HistoryResource::collection($this->collection);
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
                'combos' => ProcurementHistory::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementHistory::mapFilters(),

                /** the table header */
                'headers' => ProcurementHistory::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementHistory::getPageIcon('procurement-history'),

                /** the record key */
                'key' => ProcurementHistory::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementHistory::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementHistory::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementHistory::getPageTitle($request, 'procurement-history'),

                /** the usetrash flag */
                'usetrash' => ProcurementHistory::hasSoftDeleted(),
            ]
        ];
    }
}
