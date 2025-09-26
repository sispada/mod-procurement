<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementMethod;
use Module\System\Http\Resources\UserLogActivity;

class MethodShowResource extends JsonResource
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
            'record' => ProcurementMethod::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementMethod::mapCombos($request, $this),

                'icon' => ProcurementMethod::getPageIcon('procurement-method'),

                'key' => ProcurementMethod::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementMethod::mapStatuses($request, $this),

                'title' => ProcurementMethod::getPageTitle($request, 'procurement-method'),
            ],
        ];
    }
}
