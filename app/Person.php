<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	protected $table = 'person_business';

    protected $fillable = ['name','phone','address_line','township_id','person_business_id'];

    public $timestamps = false;

    public function staffs(){
    	return $this->hasMany('App\Staff');
    }

    public function township(){
    	return $this->belongsTo('App\Township');
    }
}
