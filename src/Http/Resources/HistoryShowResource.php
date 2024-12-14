<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementHistory;
use Module\System\Http\Resources\UserLogActivity;

class HistoryShowResource extends JsonResource
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
            'record' => ProcurementHistory::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementHistory::mapCombos($request, $this),

                'icon' => ProcurementHistory::getPageIcon('procurement-history'),

                'key' => ProcurementHistory::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementHistory::mapStatuses($request, $this),

                'title' => ProcurementHistory::getPageTitle($request, 'procurement-history'),
            ],
        ];
    }
}
