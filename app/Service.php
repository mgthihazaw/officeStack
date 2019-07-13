<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   const CREATED_AT = 'received_date';
   const UPDATED_AT = 'finished_date';

   protected $fillable = ['business_id','staff_id','service_engineer_id','customer_id','customer_name','customer_phone','customer_address',
   'received_description','received_remark','pending','service_description','service_remark'];

	public function staff(){
		return $this->belongsTo('App\Staff');
	}
 
	public function service_engineer(){
		return $this->belongsTo('App\Staff');
	}

	public function customer(){
		return $this->belongsTo('App\Customer');
   }
   public function items(){
	   return $this->belongsToMany('App\Item','service_item')
                  ->withPivot('quantity','price');
   }

   public function invoice(){
		return $this->morphOne('App\Invoice', 'invoiceable');
	}
}
