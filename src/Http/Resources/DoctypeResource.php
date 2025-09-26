<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementDoctype;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ProcurementDoctype::mapResource($request, $this);
    }
}
