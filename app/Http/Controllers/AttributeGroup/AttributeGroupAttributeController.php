<?php

namespace App\Http\Controllers\AttributeGroup;

use App\AttributeGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attribute\AttributeResource;

class AttributeGroupAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AttributeGroup $attributegroup)
    {
        $attributes = $attributegroup->attributes;

        return AttributeResource::collection($attributes);
    }
}
