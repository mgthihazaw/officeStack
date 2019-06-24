<?php

namespace App\Http\Controllers\Brand;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\ItemType\ItemTypeResource;
use App\Http\Controllers\Controller;



class BrandItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Brand $brand)
    {
        $item_types = $brand->item_types;
        return response()->json(['data' => ItemTypeResource::collection($item_types)], 200);
    }
}
