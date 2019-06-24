<?php

namespace App\Http\Requests\AttributeGroup;

use Illuminate\Foundation\Http\FormRequest;

class AttributeGroupUpdateRequest extends FormRequest
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
            'name' => 'min:1|unique:attribute_groups,name,'.$this->attributegroup->id,
            'item_type_id' => 'required|integer|exists:item_types,id'
        ];
    }
}
