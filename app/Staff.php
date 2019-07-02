<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Staff extends Authenticatable implements JWTSubject
{

    use Notifiable,EntrustUserTrait;

	protected $table = 'staffs';

    protected $fillable = ['person_business_id','department_id','business_id','username','password'];

    protected $hidden = ['password','role','secret','person_business_id'];

    public function person_business(){
    	return $this->belongsTo('App\Person');
    }

    public function business(){
    	return $this->belongsTo('App\Business');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function scopeReceptionists($query){
    	return $query->where('role_id', '=', 3);
    }

    public function scopeServiceEngineers($query){
    	return $query->where('role_id', '=', 2);
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
