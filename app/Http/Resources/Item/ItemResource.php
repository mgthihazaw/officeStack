<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Resources\Json\JsonResource;

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
        $attribute_value = array();
        foreach($this->attributes as $attribute){
            $attribute_value[$attribute->attribute_group->name] = $attribute->name;
        }

        return [
            'id' => $this->id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'brand' => $this->brand->name,
            'model' => $this->model_no,
            'item_type' => $this->item_type->name,
            'attributes' => $this->attributes->pluck('name'),
        ];
    }
}
