<?php

namespace App\Http\Controllers\Brand;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Model\ModelResource;

class BrandModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Brand $brand)
    {
        $models = $brand->models;

        return ModelResource::collection($models);
    }
}
