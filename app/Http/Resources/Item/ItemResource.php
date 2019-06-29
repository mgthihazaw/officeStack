<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\ItemType\ItemTypeResource;
use App\Http\Resources\Brand\BrandResource;


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
            'brand' => new BrandResource($this->brand),
            'model_no' => $this->model_no,
            'item_type' => new ItemTypeResource($this->item_type),
            'attributes' => AttributeResource::collection($this->attributes),
        ];
    }
}
