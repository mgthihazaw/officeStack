<?php

namespace App\Http\Controllers\Item;

use App\Item;
use App\ItemType;
use App\Attribute;
use App\Brand;
use App\Model;
use App\AttributeGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\ItemStoreRequest;
use App\Http\Resources\Item\ItemResource;

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStoreRequest $request)
    {
        foreach($request->get('attributes') as $attr_val){
            if(count($attr_val) > 1){
                return response()->json(['error' => 'Attributes value is invalid'], 500);
            }else{
                foreach ($attr_val as $attribute => $value) {
                    
                    return AttributeGroup::where('name', '=', $attribute)->where('item_type_id',$request->item_type_id)->get();
                    // if(AttributeGroup::where('name', $attribute)->where('item_type_id', $request->item_type_id)->get()->count()){

                    //     return response()->json(['error' => 'Attribute Group for this item type is invalid'], 500);
                    // }
                    // dd($value);
                }
            }
            
        }
        return DB::transaction(function() use($request){
                    
                });
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
