<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state' => 'required|integer|exists:states,id',
            'township' => 'required',
            'address_line' => 'required',
            'name' => 'required',
            'username' => 'unique:staffs,username',
            'password' => '',
            'phone' => 'required|string',
            'role' => 'required|integer',
            'business' => 'required|integer',
            'department' => 'required|integer',
        ];
    }
}
