<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemTypeAttribute\ItemTypeAttributeStoreRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\ItemType\ItemTypeResource;

use App\ItemType;
use App\Attribute;

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

        return AttributeResource::collection($attributes);
    }

    public function store(ItemTypeAttributeStoreRequest $request,ItemType $itemtype){
        $attribute = Attribute::firstOrCreate([
            'name' => $request->attribute_name
        ]);

        $itemtype->attributes()->syncWithoutDetaching($attribute);

        return new ItemTypeResource($itemtype);
    }   
}
