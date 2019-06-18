<?php

namespace App\Http\Controllers\Item;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return response()->json(['data' => $items], 200);
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
            'name' => 'required',
            'description' => 'string',
            'price' => 'integer|min:0',
            'quantity' => 'integer|min:0',
            'item_type_id' => 'required|integer|exists:item_types,id'
        ]);

        

        $item = Item::create($request->all());


        return response()->json(['data' => $item, 'message' => 'Item Created'], 201);
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
