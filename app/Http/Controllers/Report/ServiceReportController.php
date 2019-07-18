<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use DB;

class ServiceReportController extends Controller
{
    public function index(Request $request){
    	$date = $request->query('date');
    	$item_type = $request->query('item_type');
		$service_list = DB::table('services')
			->join('service_item', 'services.id', '=', 'service_item.service_id')
			->join('items', 'service_item.item_id', '=','items.id')
			->join('item_types', 'items.item_type_id', '=', 'item_types.id')
			->where('items.item_type_id', $item_type)
			->where('services.finished_date', 'LIKE', "$date%")
			->groupBy('items.item_type_id','item_types.name')
			->select('item_types.name')
			->selectRaw('SUM(service_item.price * service_item.quantity) AS total')
			->get();
  //   	SELECT s.finished_date,it.name,SUM(si.price * si.quantity) AS total  FROM services s
		// INNER JOIN service_item si ON s.id = si.service_id
		// INNER JOIN items i ON si.item_id = i.id AND i.item_type_id = 1
		// INNER JOIN item_types it ON i.item_type_id = it.id
		// WHERE finished_date LIKE "2019-06%" AND  pending = 2
		// GROUP BY i.item_type_id

    	return response()->json($service_list,200);
    }
}
