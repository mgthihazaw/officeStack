<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['home_no','street','block','location_id'];

    public function location(){
    	return $this->belongsTo('App\Location');
    }
}
