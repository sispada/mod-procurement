<?php

namespace Module\Procurement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Procurement\Models\ProcurementBiodata;
use Module\System\Http\Resources\UserLogActivity;

class BiodataShowResource extends JsonResource
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
            'record' => ProcurementBiodata::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => ProcurementBiodata::mapCombos($request, $this),

                'icon' => ProcurementBiodata::getPageIcon('procurement-biodata'),

                'key' => ProcurementBiodata::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => ProcurementBiodata::mapStatuses($request, $this),

                'title' => ProcurementBiodata::getPageTitle($request, 'procurement-biodata'),
            ],
        ];
    }
}
