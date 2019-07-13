<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public $timestamps = false;
	
	protected $fillable = ['total_price','invoiceable_id','invoiceable_type','opened_date'];

	public function invoiceable(){
		return $this->morphTo();
	}
}
