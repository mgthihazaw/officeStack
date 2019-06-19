<?php

namespace App\Http\Controllers\Item;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\ItemStoreRequest;
use App\Http\Resources\Item\ItemResource;
use App\Item;
use App\ItemType;
use App\Attribute;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id', 'DESC')->paginate(10);

        return ItemResource::collection($items);
        // return response()->json(['data' => $items], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStoreRequest $request)
    {
        $item_type= ItemType::findOrFail($request->item_type_id);
        $attributes = $request->input('attributes');

        $item = Item::create($request->only(['name','description','price','quantity','item_type_id']));

        foreach($attributes as $attribute => $value){
            $attribute = Attribute::firstOrCreate(['name' => $attribute]);
            $item_type->attributes()->syncWithoutDetaching($attribute);
            $attribute_value = $attribute->values()->firstOrCreate([
                'name' => $value
            ]);
            $item->attribute_values()->syncWithoutDetaching($attribute_value);
        }

        return response()->json(['data' => new ItemResource($item), 'message' => 'Item Created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response()->json(['data' => $item], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'string|min:1',
            'description' => 'string',
            'price' => 'integer|min:0',
            'quantity' => 'integer|min:0',
            'item_type_id' => 'required|integer|exists:item_types,id'
        ]);

        $item->update($request->all());

        return response()->json(['data' => $item, 'message' => 'Item Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json([], 204);
    }
}
