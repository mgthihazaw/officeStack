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
use App\Http\Requests\Item\ItemUpdateRequest;
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
        //return $request->all();
        return DB::transaction(function () use($request){
            $attributes = array();
          
            foreach($request->get('attributes') as $attr_val){
                if(count($attr_val) > 1){
                    return response()->json(['error' => 'Attributes value is invalid'], 400);
                }else{
                    foreach ($attr_val as $attribute => $value) {
                        
                        $attribute = (string) $attribute;
                        $attribute_group = AttributeGroup::where('name', $attribute)->where('item_type_id', $request->item_type_id)->first();
                        if($attribute_group){
                            $attributes[] = $attribute_group->attributes()->firstOrCreate(['name' => $value])->id;
                        }else{
                            DB::rollback();
                            return response()->json(['error' => "This item type doesn't have the attribute '".$attribute."'"],400);
                        }
                    }
                }
            }

            $brand = Brand::firstOrCreate(['name' => $request->brand]);

            $brand->item_types()->syncWithoutDetaching($request->item_type_id);

            $item = Item::create([
                'price_one' => $request->price_one,
                'brand_id' => $brand->id,
                'item_type_id' => $request->item_type_id,
                'model_no' => $request->model_no
            ]);
            $item->attributes()->sync($attributes);
            return response()->json(['data' => new ItemResource($item)], 201);
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
        return response()->json(['data' => new ItemResource($item)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUpdateRequest $request, Item $item)
    {
        
        return DB::transaction(function () use($request,$item){
            $attributes = array();

            foreach($request->get('attributes') as $attr_val){
                if(count($attr_val) > 1){
                    return response()->json(['error' => 'Attributes value is invalid'], 400);
                }else{
                    foreach ($attr_val as $attribute => $value) {
                        $attribute = (string) $attribute;
                        $attribute_group = AttributeGroup::where('name', $attribute)->where('item_type_id', $request->item_type_id)->first();
                        if($attribute_group){
                            $attributes[] = $attribute_group->attributes()->firstOrCreate(['name' => $value])->id;
                        }else{
                            DB::rollback();
                            return response()->json(['error' => "This item type doesn't have the attribute '".$attribute."'"],400);
                        }
                    }
                }
            }
            $brand = Brand::firstOrCreate(['name' => $request->brand]);
            $item->update([
                'price' => $request->price,
                'brand_id' => $brand->id,
                'item_type_id' => $request->item_type_id,
                'model_no' => $request->model_no
            ]);


            $item->attributes()->sync($attributes);
            return response()->json(['data' => new ItemResource($item), 'message' => 'Item Updated'], 200);
        });

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

    public function search(Request $request){
        
        $query = Item::select('items.*');
        $query = Item::query();

        
        if($request->query('item_type')){
            $query->where('item_type_id', $request->query('item_type'));
            
        }

        if($request->query('brand')){
            $query->where('brand_id', $request->query('brand'));
        }

        if($request->query('attributes')){
            // $attributes = explode(',', $request->query('attributes'));
            foreach ($request->query('attributes') as $key => $attribute) {
                $index = $key + 1;
                $query->leftjoin("attribute_item as col".$index, "items.id", "=", "col".$index."."."item_id")
                       
                        ->where("col".$index."."."attribute_id", $attribute);
            }
        }

        DB::enableQueryLog();
        $results = $query->paginate(10);
        // dd(DB::getQueryLog());
  
        $items = ItemResource::collection($results->getCollection());
       
        return response()->json([
            'data' => $items,
            'meta' => ['total' => $results->total(),
                'from' =>($results->perPage()* ($results->currentPage()-1))+1,
                'count' => $results->count(),
                'per_page' => $results->perPage(),
                // 'current_page' => $results->currentPage(),
                'total_pages' => $results->lastPage(),
                'next_page' => $results->nextPageUrl(),
                'previous_page' => $results->previousPageUrl(),
                'last_page' => $results->lastPage()
            ],
            "links" => [
                'first' => $results->url(1),
                'last' => $results->lastPage(),
                'next' => $results->nextPageUrl(),
                'previous' => $results->previousPageUrl()
            ]
        ], 200);
    }
}
