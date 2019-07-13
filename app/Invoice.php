<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public $timestamps = false;

	public function invoiceable(){
		return $this->morphTo();
	}
}
