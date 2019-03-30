<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['business_name','business_type_id','address_id'];

    public $timestamps = false;

    public function person_business(){
    	return $this->belongsTo('App\Person');
    }
}
