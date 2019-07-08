<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['price_one', 'quantity', 'brand_id','item_type_id','model_no'];

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

    public function services(){
        return $this->belongsToMany('App\Service','service_item')
                    ->withPivot('quantity','price');
    }
}
