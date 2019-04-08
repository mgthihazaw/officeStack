<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Staff extends Authenticatable implements JWTSubject
{

    use Notifiable;

	protected $table = 'staffs';

	public $timestamps = false;

    protected $fillable = ['person_business_id','role_id','business_id','username','password'];

    protected $hidden = ['password','role','secret','person_business_id'];

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


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function hasPermission($permission){
        $permissions = [];
        foreach($this->role->permissions as $permiss){
            array_push($permissions, $permiss->permission);
        }
        return in_array($permission, $permissions) ? true : false;
    }
}
