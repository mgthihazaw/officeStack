<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class StateController extends Controller
{
    public function index(){
    	return response()->json(Location::where('location_id', 1)->get());
    }


    public function getTownships($id){
    	$townships = Location::where('location_id', '=', $id)->get();

    	return response()->json($townships);
    }
}
