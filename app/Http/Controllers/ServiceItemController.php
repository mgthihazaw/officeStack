<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceItem;

class ServiceItemController extends Controller
{
 
    public function store(Request $request)
    {
        
         $item= ServiceItem::firstOrCreate($request->all());
         return response()->json($item, 200);
    }

   
    public function destroy($id)
    {
      $item= ServiceItem::findOrFail($id)->delete();
      
      return response()->json($item, 200);
    }
}
