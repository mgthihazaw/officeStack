<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = ['name', 'attribute_id'];

    public function attribute(){
    	return $this->belongsTo('App\Attribute');
    }
}
