<?php

namespace App\Http\Resources\ItemType;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Attribute\AttributeResource;

class AttributeGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attributes' => AttributeResource::collection($this->attributes),
        ];
    }
}
