<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
	protected $table = 'staffs';

	public $timestamps = false;

    protected $fillable = ['person_business_id','role_id','business_id'];

    public function person_business(){
    	return $this->belongsTo('App\Person');
    }

    public function role(){
    	return $this->belongsTo('App\Role');
    }

    public function business(){
    	return $this->belongsTo('App\Business');
    }

    public function scopeReceptionists($query){
    	return $query->where('role_id', '=', 3);
    }

    public function scopeServiceEngineers($query){
    	return $query->where('role_id', '=', 2);
    }
}
