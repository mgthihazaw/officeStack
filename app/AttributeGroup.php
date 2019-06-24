<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $fillable = ['name'];

    public function attributes(){
    	return $this->hasMany('App\Attribute');
    }
}
