<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementOfficer;
use Module\System\Http\Resources\UserLogActivity;

class OfficerShowResource extends JsonResource
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
            'record' => ProcurementOfficer::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementOfficer::mapCombos($request, $this),

                'icon' => ProcurementOfficer::getPageIcon('procurement-officer'),

                'key' => ProcurementOfficer::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementOfficer::mapStatuses($request, $this),

                'title' => ProcurementOfficer::getPageTitle($request, 'procurement-officer'),
            ],
        ];
    }
}
