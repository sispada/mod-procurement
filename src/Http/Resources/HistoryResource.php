<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementHistory;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ProcurementHistory::mapResource($request, $this);
    }
}
