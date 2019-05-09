<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'item','quantity','price','service_id'
    ];

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
