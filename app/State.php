<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'locations';

    protected $fillable = ['name', 'location_id'];
}
