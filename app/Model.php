<?php

namespace App;

use Illuminate\Database\Eloquent\Model as MainModel;

class Model extends MainModel
{
    protected $fillable = ['name','brand_id'];

    public function brand(){
    	return $this->belongsTo('App\Brand');
    }
}
