<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ItemType\ItemTypeResource;

class ItemResource extends JsonResource
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
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'item_type' => [
                'id' => $this->item_type->id,
                'name' => $this->item_type->name,
                'links' => [
                    'self' => route('itemtypes.show', $this->item_type->id),
                    'items' => route('itemtypes.items.index', $this->item_type->id)
                ]
            ],
            'attributes' => $this->attribute_values->transform(function($attribute_value){
                return [
                    $attribute_value->attribute->name => $attribute_value->name
                ];
            }),
            'links' => [
                'self' => route('items.show', $this->id)
            ]
        ];
    }
}
