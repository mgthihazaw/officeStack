<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;
use App\Http\Resources\Brand\BrandResource;


class BrandController extends Controller
{
    public function index(){
    	$brands = Brand::orderBy('id', 'DESC')->get();
    	return response()->json(['data' => BrandResource::collection($brands) ], 200);
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
