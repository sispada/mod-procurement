<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementWorkbio;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkbioCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return WorkbioResource::collection($this->collection);
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
                'combos' => ProcurementWorkbio::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementWorkbio::mapFilters(),

                /** the table header */
                'headers' => ProcurementWorkbio::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementWorkbio::getPageIcon('procurement-workbio'),

                /** the record key */
                'key' => ProcurementWorkbio::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementWorkbio::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementWorkbio::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementWorkbio::getPageTitle($request, 'procurement-workbio'),

                /** the usetrash flag */
                'usetrash' => ProcurementWorkbio::hasSoftDeleted(),
            ]
        ];
    }
}
