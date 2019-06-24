<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name','attribute_group_id'];

    public function attribute_group(){
    	return $this->belongsTo('App\AttributeGroup');
    }
}
