<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['person_business_id', 'business_type_id'];

    public $timestamps = false;

    public function person_business(){
    	return $this->belongsTo('App\Person');
    }

    public function departments(){
    	return $this->belongsToMany('App\Department', 'business_has_departments');
    }
}
