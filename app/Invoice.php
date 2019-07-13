<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public $timestamps = false;
	
	protected $fillable = ['service_id','total_price','invoiceable_id','invoiceable_type'];

	public function invoiceable(){
		return $this->morphTo();
	}
}
