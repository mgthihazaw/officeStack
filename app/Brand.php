<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name'];

    public function item_types(){
    	return $this->belongsToMany('App\ItemType');
    }

    public function models(){
    	return $this->hasMany('App\Model');
    }

    
}
