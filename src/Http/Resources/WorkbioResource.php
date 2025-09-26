<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementWorkbio;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkbioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ProcurementWorkbio::mapResource($request, $this);
    }
}
