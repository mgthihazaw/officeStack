<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	protected $table = 'person_business';

    protected $fillable = ['name','phone','person_business_id','address_id'];

    public function staffs(){
    	return $this->hasMany('App\Staff');
    }

    public function address(){
    	return $this->belongsTo('App\Address');
    }
}
