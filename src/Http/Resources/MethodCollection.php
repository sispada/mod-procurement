<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementMethod;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MethodCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MethodResource::collection($this->collection);
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
                'combos' => ProcurementMethod::mapCombos($request),

                /** the page data filter */
                'filters' => ProcurementMethod::mapFilters(),

                /** the table header */
                'headers' => ProcurementMethod::mapHeaders($request),

                /** the page icon */
                'icon' => ProcurementMethod::getPageIcon('procurement-method'),

                /** the record key */
                'key' => ProcurementMethod::getDataKey(),

                /** the page default */
                'recordBase' => ProcurementMethod::mapRecordBase($request),

                /** the page statuses */
                'statuses' => ProcurementMethod::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => ProcurementMethod::getPageTitle($request, 'procurement-method'),

                /** the usetrash flag */
                'usetrash' => ProcurementMethod::hasSoftDeleted(),
            ]
        ];
    }
}
