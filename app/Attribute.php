<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name','item_type_id'];

    public function item_type(){
    	return $this->belongsTo('App\ItemType');
    }

    public function values(){
    	return $this->hasMany('App\AttributeValue');
    }
}
