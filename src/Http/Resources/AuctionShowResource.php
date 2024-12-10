<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementAuction;
use Module\System\Http\Resources\UserLogActivity;

class AuctionShowResource extends JsonResource
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
            'record' => ProcurementAuction::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementAuction::mapCombos($request, $this),

                'icon' => ProcurementAuction::getPageIcon('procurement-auction'),

                'key' => ProcurementAuction::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementAuction::mapStatuses($request, $this),

                'title' => ProcurementAuction::getPageTitle($request, 'procurement-auction'),
            ],
        ];
    }
}
