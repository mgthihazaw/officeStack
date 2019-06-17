<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ItemType;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_types = ItemType::all();

        return response()->json(['data' => $item_types], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $item_type = ItemType::create([
            'name' => $request->name
        ]);

        return response()->json(['data' => $item_type,'message' => 'Item Type Created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ItemType $itemtype)
    {
        return response()->json(['data' => $itemtype], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemType $itemtype)
    {
        $request->validate([
            'name' => 'string|min:1',
        ]);

        $itemtype->update($request->all());

        return response()->json(['data' => $itemtype, 'message' => 'Item Type Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemType $itemtype)
    {
        $itemtype->delete();

        return response()->json([], 204);
    }
}
