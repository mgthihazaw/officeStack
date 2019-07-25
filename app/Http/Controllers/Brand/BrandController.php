<?php

namespace App\Http\Controllers\Brand;

use DB;
use App\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Http\Controllers\Controller;


class BrandController extends Controller
{
    public function index(Request $request){
        if($request->query('item_type')){
            $item_type = $request->query('item_type');
            $service_brands = DB::table('item_types')
                                ->join('brand_item_type', 'item_types.id', '=', 'brand_item_type.item_type_id')
                                ->join('brands', 'brand_item_type.brand_id', '=', 'brands.id')
                                ->where('item_types.name', $item_type)
                                ->select('brands.id','brands.name')
                                ->get();
            
            return response()->json(['data' => $service_brands], 200);
        }
    	$brands = Brand::orderBy('id', 'DESC')->paginate(15);
        return BrandResource::collection($brands);
    	//return response()->json(['data' => BrandResource::collection($brands) ], 200);
    }

    public function store(BrandStoreRequest $request){
    	$brand = Brand::create($request->all());
    	return response()->json(['data' => new BrandResource($brand) ], 201);
    }

    public function show(Request $request, Brand $brand){
    	return response()->json(['data' => new BrandResource($brand)], 200);
    }

    public function update(BrandUpdateRequest $request, Brand $brand){
    	$brand->update($request->all());
    	return response()->json(['data' => new BrandResource($brand)], 200);
    }

    public function destroy(Brand $brand){
    	$brand->delete();

    	return response()->json([], 204);
    }

}
