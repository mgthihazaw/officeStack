<?php

namespace App\Http\Requests\ItemTypeAttribute;

use Illuminate\Foundation\Http\FormRequest;

class ItemTypeAttributeStoreRequest extends FormRequest
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
            'item_type_id' => 'required|exists:item_types,id',
            'attribute_name' => 'required|min:1'
        ];
    }
}
