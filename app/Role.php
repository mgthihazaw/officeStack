<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role'];

    public function staff(){
    	return $this->hasOne('App\Staff');
    }

    public function department(){
    	return $this->belongsTo('App\Department');
    }
}
