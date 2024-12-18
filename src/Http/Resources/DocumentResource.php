<?php

namespace Module\Procurement\Http\Resources;

use Module\Procurement\Models\ProcurementDocument;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ProcurementDocument::mapResource($request, $this);
    }
}
