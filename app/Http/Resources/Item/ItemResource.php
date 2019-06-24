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
        return [
            'id' => $this->id,
            'price' => $this->quantity,
            'quantity' => $this->quantity,
            'brand' => $this->brand->name,
            'model' => $this->model->name,
            'item_type' => $this->item_type->name,
        ];
    }
}
