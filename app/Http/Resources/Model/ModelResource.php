<?php

namespace App\Http\Resources\Model;

use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
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
            'brand' => $this->brand->name,
            'links' => [
                'self' => route('models.show', $this->id)
            ]
        ];  
    }
}
