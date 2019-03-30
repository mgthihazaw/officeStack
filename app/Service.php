<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   	protected $fillable = ['staff_id','service_engineer_id','customer_id','customer_name','customer_phone','township','description','remark','pending'];

   	public function staff(){
   		return $this->belongsTo('App\Staff');
   	}

   	public function service_engineer(){
   		return $this->belongsTo('App\Staff');
   	}

   	public function customer(){
   		return $this->belongsTo('App\Customer');
   	}
}
