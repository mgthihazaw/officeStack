<?php

namespace App\Http\Requests\ServiceItem;

use Illuminate\Foundation\Http\FormRequest;

class ServiceItemStoreRequest extends FormRequest
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
            'service_item' => 'array|min:1',
            'service_item.*.item_id' => 'integer|exists:items,id',
            'service_item.*.quantity' => 'integer|min:1',
            'service_item.*.price' => 'integer'
        ];
    }
}
