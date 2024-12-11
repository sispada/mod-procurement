<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementWorkgroup;
use Module\System\Http\Resources\UserLogActivity;

class WorkgroupShowResource extends JsonResource
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
            'record' => ProcurementWorkgroup::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementWorkgroup::mapCombos($request, $this),

                'icon' => ProcurementWorkgroup::getPageIcon('procurement-workgroup'),

                'key' => ProcurementWorkgroup::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementWorkgroup::mapStatuses($request, $this),

                'title' => ProcurementWorkgroup::getPageTitle($request, 'procurement-workgroup'),
            ],
        ];
    }
}
