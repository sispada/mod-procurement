<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementMember;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MemberCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MemberResource::collection($this->collection);
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
                'combos' => ProcurementMember::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementMember::mapFilters(),

                /** the table header */
                'headers' => ProcurementMember::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementMember::getPageIcon('procurement-member'),

                /** the record key */
                'key' => ProcurementMember::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementMember::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementMember::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementMember::getPageTitle($request, 'procurement-member'),

                /** the usetrash flag */
                'usetrash' => ProcurementMember::hasSoftDeleted(),
            ]
        ];
    }
}
