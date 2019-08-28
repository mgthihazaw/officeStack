<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ServiceEvent;
// use App\Http\Resources\ServiceResource;

class Service extends Model
{
	



   public $timestamps  = false;

   protected $fillable = ['business_id','staff_id','service_engineer_id','customer_id','customer_name','customer_phone','customer_address',
   'received_description','received_remark','pending','service_description','service_remark','received_date','finished_date'];

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

	public static function boot() {



	    parent::boot();



	    static::created(function($service) {

	        event(new ServiceEvent($service));

	    });



	    static::updated(function($service) {

	        event(new ServiceEvent($service));

	    });



	    static::deleted(function($service) {

	        event(new ServiceEvent($service));

	    });

	}


}
