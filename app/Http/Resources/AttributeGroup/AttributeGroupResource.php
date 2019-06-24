<?php

namespace App\Http\Resources\AttributeGroup;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'item_type' => $this->item_type->name,
            'links' => [
                'self' => route('attributegroups.show', $this->id)
            ]
        ];
    }
}
