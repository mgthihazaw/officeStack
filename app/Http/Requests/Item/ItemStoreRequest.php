<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AssociativeArray;

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
            'price_one' => 'required|integer|min:1|max:999999', 
            'brand' => 'required|max:100',
            'item_type_id' => 'required|integer|exists:item_types,id',
            // 'model_no' => 'unique:items,model_no',
            'attributes' => ['sometimes',new AssociativeArray()],
            'attributes.*.*' => 'string',
        ];
    }
}
