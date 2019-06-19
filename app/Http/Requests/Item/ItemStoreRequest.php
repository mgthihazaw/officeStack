<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'item_type_id' => 'required|integer|exists:item_types,id',
            'attributes' => 'array'
        ];
    }
}
