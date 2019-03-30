<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'no' => $this->id,
            'name' => $this->person_business->name,
            'phone' => $this->person_business->phone,
            'address' => $this->person_business->address,
            'township' => $this->person_business->address->location->name,
            'state' => $this->person_business->address->location->location->name,
            'role' => $this->role->name,
            'role_id' => $this->role_id,
            'business' => $this->business->person_business->name,
            'business_id' => $this->business_id,
            'department' => $this->role->department->department_name,
            'department_id' => $this->role->department_id,
        ];
    }
}
