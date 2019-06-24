<?php

namespace App\Http\Controllers\Attribute;

use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Requests\Attribute\AttributeStoreRequest;
use App\Http\Requests\Attribute\AttributeUpdateRequest;


class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::orderBy('id','DESC')->paginate(15);

        return AttributeResource::collection($attributes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeStoreRequest $request)
    {
        $attribute = Attribute::create($request->all());

        return response()->json(['data' => new AttributeResource($attribute)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        return response()->json(['data' => new AttributeResource($attribute)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeUpdateRequest $request, Attribute $attribute)
    {
        $attribute->update($request->all());

        return response()->json(['data' => new AttributeResource($attribute)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return response()->json(['message' => 'Deleted'], 410);
    }
}
