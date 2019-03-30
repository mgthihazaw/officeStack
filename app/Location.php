<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name','location_id'];

    public function location(){
    	return $this->belongsTo('App\Location');
    }
}
