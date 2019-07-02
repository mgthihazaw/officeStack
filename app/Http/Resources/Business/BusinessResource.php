<?php

namespace App\Http\Resources\Business;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Township\TownshipResource;
use App\Http\Resources\State\StateResource;


class BusinessResource extends JsonResource
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
            'name' => $this->person_business->name,
            'phone' => $this->person_business->phone,
            'address' => $this->person_business->address_line,
            'township' => new TownshipResource($this->person_business->township),
            'state' => new StateResource($this->person_business->township->state),
        ];
    }
}
