<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'customer_name' => $this->customer_id == null ? $this->customer_name : $this->customer->person_business->name,
            'customer_phone' => $this->customer_id == null ? $this->customer_phone : $this->customer->person_business->phone,
            'township' => $this->customer_id == null ? $this->township : $this->customer->person_business->address->location->name,
            'staff' => $this->staff->person_business->name,
            'staff_id' => $this->staff->id,
            'service_engineer' => $this->service_engineer === null ? '----' : $this->service_engineer->person_business->name,
            
            'description' => $this->description,
            'remark' => $this->remark,
            'pending' => $this->pending,
            'service_description' => $this->service_description,
            'service_remark' => $this->service_remark,
            'created_at' =>$this->created_at,
        ];
    }
}
