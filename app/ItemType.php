<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $fillable = ['name'];

    public function attribute_groups(){
    	return $this->hasMany('App\AttributeGroup');
    }

    public function items(){
    	return $this->hasMany('App\Item');
    }

    public function brands(){
    	return $this->belongsToMany('App\Brand','brand_item_type');
    }
    public function scopeService(){
        return $this->where('name','Service');
    }
}
