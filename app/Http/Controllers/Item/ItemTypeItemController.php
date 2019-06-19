<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Item\ItemResource;
use App\ItemType;

class ItemTypeItemController extends Controller
{
    public function index(Request $request,ItemType $itemtype){
    	$items = $itemtype->items()->orderBy('id','DESC')->get();
    	return ItemResource::collection($items);
    }	
}
