<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['price', 'quantity', 'brand_id','item_type_id','model_no'];

    public function item_type(){
    	return $this->belongsTo('App\ItemType');
    }

    public function model(){
    	return $this->belongsTo('App\Model');
    }

    public function brand(){
        return $this->belongsTo('App\Brand');
    }

    public function attributes(){
        return $this->belongsToMany('App\Attribute');
    }
}
