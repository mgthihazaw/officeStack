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

        $attributes = $this->unique_multi_array($attributes, 'name');

        $result = DB::transaction(function() use($request,$item_type,$attributes){
            try{
                $item = Item::create($request->only(['name','description','price','quantity','item_type_id']));

                foreach($attributes as $index => $attr){

                    $attribute = Attribute::firstOrCreate(['name' => $attr['name']]);

                    $item_type->attributes()->syncWithoutDetaching($attribute);
                    
                    $attribute_value = $attribute->values()->firstOrCreate([
                        'name' => $attr['value']
                    ]);
                    $item->attribute_values()->syncWithoutDetaching($attribute_value);
                }
                return response()->json(['data' => new ItemResource($item), 'message' => 'Item Created'], 201);
            }catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }
            
        });
        return $result;
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
