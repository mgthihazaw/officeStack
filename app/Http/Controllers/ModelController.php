<?php

namespace App\Http\Controllers;

use App\Model;
use Illuminate\Http\Request;
use App\Http\Resources\Model\ModelResource;
use App\Http\Requests\Model\ModelStoreRequest;
use App\Http\Requests\Model\ModelUpdateRequest;


class ModelController extends Controller
{
    public function index(){
    	$models = Model::orderBy('id', 'DESC')->paginate(15);
    	return ModelResource::collection($models);
    }


    public function store(ModelStoreRequest $request){
    	$model = Model::create($request->all());

    	return response()->json(['data' => new ModelResource($model)], 201);
    }

    public function show(Model $model){
    	return response()->json(['data' => new ModelResource($model)], 200);
    }

    public function update(ModelUpdateRequest $request, Model $model){
    	$model->update($request->all());

    	return response()->json(['data' => new ModelResource($model)], 200);
    }

    public function destroy(Model $model){
    	$model->delete();

    	return response()->json([], 204);
    }
}
