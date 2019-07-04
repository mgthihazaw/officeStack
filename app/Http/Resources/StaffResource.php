<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Township\TownshipResource;
use App\Http\Resources\State\StateResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Business\BusinessResource;
use App\Http\Resources\Department\DepartmentResource;


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
        $departments = [];
        foreach($this->roles as $role){
            $departments[] = $role->department;
        }
        return [
            'id' => $this->id,
            'name' => $this->person_business->name,
            'phone' => $this->person_business->phone,
            'username' => $this->username,
            'address' => $this->person_business->address_line,
            'township' => new TownshipResource($this->person_business->township),
            'state' => new StateResource($this->person_business->township->state),
            'role' => new RoleResource($this->roles()->first()),
            'business' => new BusinessResource($this->business),
            'department' => new DepartmentResource($this->roles()->first()->department)
        ];
    }
}
