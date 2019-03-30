<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['person_business_id'];

    public function person_business(){
    	return $this->belongsTo('App\Person');
    }
}
