<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ItemType;

class ItemTypeAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,ItemType $itemtype)
    {
        $attributes = $itemtype->attributes;

        return $attributes;
    }
}
