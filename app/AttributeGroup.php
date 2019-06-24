<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $fillable = ['name','item_type_id'];

    public function attributes(){
    	return $this->hasMany('App\Attribute');
    }

    public function item_type(){
    	return $this->belongsTo('App\ItemType');
    }
}
