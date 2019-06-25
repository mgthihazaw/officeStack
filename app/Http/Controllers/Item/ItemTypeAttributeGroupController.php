<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemType\ItemTypeAttributeGroupStoreRequest;
use App\Http\Resources\AttributeGroup\AttributeGroupResource;
use App\Http\Resources\ItemTpe\ItemTypeResource;


use App\ItemType;
use App\AttributeGroup;

class ItemTypeAttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,ItemType $itemtype)
    {
        $attribute_groups = $itemtype->attribute_groups;

        return AttributeGroupResource::collection($attribute_groups);
    }

    public function store(ItemTypeAttributeGroupStoreRequest $request, ItemType $itemtype){
        $itemtype->attribute_groups()->create(['name' => $request->name]);

        $attribute_groups = $itemtype->attribute_groups;
        
        return AttributeGroupResource::collection($attribute_groups);
    }
}
