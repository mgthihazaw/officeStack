<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AttributeValue;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute_values = AttributeValue::all();

        return response()->json(['data' => $attribute_values], 200);
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
            'item_attribute_id' => 'required|integer|exists:attributes,id'
        ]);

        $attribute_value = AttributeValue::create($request->all());

        return response()->json(['data' => $attribute_value, 'message' => 'Attribute Value Created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeValue $attributevalue)
    {
        return response()->json(['data' => $attributevalue], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeValue $attributevalue)
    {
        $request->validate([
            'name' => 'string|min:1',
            'item_attribute_id' => 'integer|exists:attributes,id'
        ]);

        $attributevalue->update($request->all());

        return response()->json(['data' => $attributevalue, 'message' => 'Attribute Value Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeValue $attribute_value)
    {
        $attribute_value->delete();

        return response()->json([], 204);
    }
}
