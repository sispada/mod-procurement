<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementWorkunit;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkunitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ProcurementWorkunit::mapResource($request, $this);
    }
}
