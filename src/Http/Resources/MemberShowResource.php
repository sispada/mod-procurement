<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementMember;
use Module\System\Http\Resources\UserLogActivity;

class MemberShowResource extends JsonResource
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
            'record' => ProcurementMember::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementMember::mapCombos($request, $this),

                'icon' => ProcurementMember::getPageIcon('procurement-member'),

                'key' => ProcurementMember::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementMember::mapStatuses($request, $this),

                'title' => ProcurementMember::getPageTitle($request, 'procurement-member'),
            ],
        ];
    }
}
