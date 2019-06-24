<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\AttributeGroup;
use App\ItemType;

class Attribute implements Rule
{
    private $item_type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($item_type)
    {
        $this->item_type = ItemType::findOrFail($item_type);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $attribute => $value) {
            if(!$this->attr_group_exists($attribute)){
                return false;
            }
        }
    }

    protected function attr_group_exists($attribute_group){
        if(AttributeGroup::where('name', $attribute_group)->where('item_type_id', $this->item_type->id)->get()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
