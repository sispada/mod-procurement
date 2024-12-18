<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementBiodata;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BiodataCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return BiodataResource::collection($this->collection);
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
                'combos' => ProcurementBiodata::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementBiodata::mapFilters(),

                /** the table header */
                'headers' => ProcurementBiodata::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementBiodata::getPageIcon('procurement-biodata'),

                /** the record key */
                'key' => ProcurementBiodata::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementBiodata::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementBiodata::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementBiodata::getPageTitle($request, 'procurement-biodata'),

                /** the usetrash flag */
                'usetrash' => ProcurementBiodata::hasSoftDeleted(),
            ]
        ];
    }
}
