<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Department;

class LoginController extends Controller
{
    public function index(){
    	$businesses = Business::all();
    	$departments = Department::all();

    	foreach($businesses as $business){
    		$business->name = $business->person_business->name;
    	}

    	return view('login')->withOrganizations($businesses)->withDepartments($departments);
    }
}
