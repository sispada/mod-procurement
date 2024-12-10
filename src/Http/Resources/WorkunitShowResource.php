<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementWorkunit;
use Module\System\Http\Resources\UserLogActivity;

class WorkunitShowResource extends JsonResource
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
            'record' => ProcurementWorkunit::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementWorkunit::mapCombos($request, $this),

                'icon' => ProcurementWorkunit::getPageIcon('procurement-workunit'),

                'key' => ProcurementWorkunit::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementWorkunit::mapStatuses($request, $this),

                'title' => ProcurementWorkunit::getPageTitle($request, 'procurement-workunit'),
            ],
        ];
    }
}
