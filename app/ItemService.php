<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemService extends Pivot
{
    protected $table = "service_item";

    public $timestamps = false;
}
