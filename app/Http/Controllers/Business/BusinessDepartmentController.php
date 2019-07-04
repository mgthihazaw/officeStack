<?php

namespace App\Http\Controllers\Business;

use App\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Department\DepartmentResource;

class BusinessDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {
        $departments = $business->departments;

        return response()->json(['data' => DepartmentResource::collection($departments)], 200);
    }
}
