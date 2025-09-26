<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementDoctype;
use Module\System\Http\Resources\UserLogActivity;

class DoctypeShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            /**
             * the record data
             */
            'record' => ProcurementDoctype::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementDoctype::mapCombos($request, $this),

                'icon' => ProcurementDoctype::getPageIcon('procurement-doctype'),

                'key' => ProcurementDoctype::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementDoctype::mapStatuses($request, $this),

                'title' => ProcurementDoctype::getPageTitle($request, 'procurement-doctype'),
            ],
        ];
    }
}
