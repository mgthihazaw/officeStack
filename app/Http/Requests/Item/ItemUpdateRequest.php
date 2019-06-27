<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AssociativeArray;

class ItemUpdateRequest extends FormRequest
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
            'brand' => 'required|integer|exists:brands,id',
            'item_type_id' => 'required|integer|exists:item_types,id',
            'model_no' => 'unique:items,model_no,'.$this->item->id,
            'attributes' => ['required',new AssociativeArray()],
        ];
    }
}
