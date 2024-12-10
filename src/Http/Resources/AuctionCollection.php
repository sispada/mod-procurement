<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementAuction;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuctionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return AuctionResource::collection($this->collection);
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
                'combos' => ProcurementAuction::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementAuction::mapFilters(),

                /** the table header */
                'headers' => ProcurementAuction::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementAuction::getPageIcon('procurement-auction'),

                /** the record key */
                'key' => ProcurementAuction::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementAuction::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementAuction::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementAuction::getPageTitle($request, 'procurement-auction'),

                /** the usetrash flag */
                'usetrash' => ProcurementAuction::hasSoftDeleted(),
            ]
        ];
    }
}
