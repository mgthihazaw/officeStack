<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Township;

class StateController extends Controller
{
    public function index(){
    	return response()->json(State::orderBy('id','DESC')->get());
    }


    public function getTownships($id){
    	$townships = Township::where('state_id', '=', $id)->get();

    	return response()->json($townships);
    }
}
