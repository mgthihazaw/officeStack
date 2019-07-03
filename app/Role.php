<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name','display_name','description','department_id'];

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
