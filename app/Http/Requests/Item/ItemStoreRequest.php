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
            'price' => 'required|integer|min:1|max:999999', 
            'quantity' => 'required|integer|min:0|max:9999', 
            'brand_id' => 'required|integer|exists:brands,id',
            'item_type_id' => 'required|integer|exists:item_types,id',
            'model' => 'required',
            'attributes' => 'required|array',
            'attributes.*' => 'array',
            'attributes.*[]' => 'required|exists:attribute_groups,name'
        ];
    }
}
