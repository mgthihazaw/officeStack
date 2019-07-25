<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use DB;

class ServiceReportController extends Controller
{
    public function index(Request $request){
		$date = explode(" ",now())[0];
		$date = substr($date,0,7);

		$query = DB::table('services')
					->join('service_item', 'services.id', '=', 'service_item.service_id')
					->join('items', 'service_item.item_id', '=','items.id')
					->join('item_types', 'items.item_type_id', '=', 'item_types.id');

		if($request->query('date')){
			$date = $request->query('date');
		}
		$query->where('services.finished_date', 'LIKE', "$date%");


		if($request->query('brand')){
			$brand = $request->query('brand');
			$query->where('items.brand_id', $brand);
		}else{
			$query->where('item_types.name' , "Service");
		}
		$service_list = $query
							->groupBy(DB::raw('DATE(services.finished_date)'),'item_types.name')
							->orderBy('services.finished_date', 'ASC')
							->select('item_types.name',DB::raw('DATE(services.finished_date) AS date'))
							->selectRaw('SUM(service_item.price * service_item.quantity) AS total')
							->get();

    	return response()->json($service_list,200);
    }
}
