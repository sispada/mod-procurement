<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementWorkgroup;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkgroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ProcurementWorkgroup::mapResource($request, $this);
    }
}
