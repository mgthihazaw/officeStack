<?php

namespace App\Http\Controllers\AttributeGroup;

use App\AttributeGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttributeGroup\AttributeGroupResource;
use App\Http\Requests\AttributeGroup\AttributeGroupStoreRequest;
use App\Http\Requests\AttributeGroup\AttributeGroupUpdateRequest;



class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attr_groups = AttributeGroup::orderBy('id', 'DESC')->paginate(15);

        return AttributeGroupResource::collection($attr_groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeGroupStoreRequest $request)
    {

        $attr_group = AttributeGroup::create($request->all());

        return response()->json(['data' => new AttributeGroupResource($attr_group)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeGroup $attributegroup)
    {
        return response()->json(['data' => new AttributeGroupResource($attributegroup)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeGroupUpdateRequest $request, AttributeGroup $attributegroup)
    {
        $attributegroup->update($request->all());
        return response()->json(['data' => new AttributeGroupResource($attributegroup)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeGroup $attributegroup)
    {
        $attributegroup->delete();
        return response()->json(['message' => 'Deleted'], 204);
    }
}
