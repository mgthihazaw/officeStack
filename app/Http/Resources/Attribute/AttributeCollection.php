<?php

namespace App\Http\Resources\Attribute;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AttributeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($attribute){
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'links' => [
                        'self' => route('attributes.show', $attribute->id)
                    ]
                ];
            }),
        ];
    }
}
