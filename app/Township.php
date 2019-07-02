<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $fillable = ['name', 'state_id'];

    public $timestamps = false;
}
