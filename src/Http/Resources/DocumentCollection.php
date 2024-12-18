<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementDocument;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DocumentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return DocumentResource::collection($this->collection);
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
                'combos' => ProcurementDocument::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementDocument::mapFilters(),

                /** the table header */
                'headers' => ProcurementDocument::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementDocument::getPageIcon('procurement-document'),

                /** the record key */
                'key' => ProcurementDocument::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementDocument::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementDocument::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementDocument::getPageTitle($request, 'procurement-document'),

                /** the usetrash flag */
                'usetrash' => ProcurementDocument::hasSoftDeleted(),
            ]
        ];
    }
}
