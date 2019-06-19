<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'price', 'quantity', 'item_type_id'];

    public function item_type(){
    	return $this->belongsTo('App\ItemType');
    }

    public function attribute_values(){
    	return $this->belongsToMany('App\AttributeValue', 'item_attribute_values');
    }
}
