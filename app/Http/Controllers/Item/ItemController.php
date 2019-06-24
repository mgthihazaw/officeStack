<?php

namespace App\Http\Controllers\Item;

use App\Item;
use App\ItemType;
use App\Attribute;
use App\Brand;
use App\Model;
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
        return DB::transaction(function() use($request){
                    $brand = Brand::findOrFail($request->brand_id);
                    $item_type = ItemType::findOrFail($request->item_type_id);

                    $model = Model::firstOrCreate([
                        'name' => $request->model,
                        'brand_id' => $brand->id
                    ]);
                    //dd($request->get('attributes'));

                    foreach($request->get('attributes') as $attr){
                        foreach($attr as $attribute => $value){
                            
                        }
                    }
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

    private function unique_multi_array($array, $key) { 
        $temp_array = array();
        $i = 0; 
        $key_array = array(); 
      
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val;
            }else{
                $temp_array[array_search($val[$key], $key_array)]['value'] = $val['value'];
            }
            $i++;
        }
        
        return $temp_array; 
    }
}
