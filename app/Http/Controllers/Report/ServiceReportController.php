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


  //   	SELECT s.finished_date,it.name,SUM(si.price * si.quantity) AS total  FROM services s
		// INNER JOIN service_item si ON s.id = si.service_id
		// INNER JOIN items i ON si.item_id = i.id AND i.item_type_id = 1
		// INNER JOIN item_types it ON i.item_type_id = it.id
		// WHERE finished_date LIKE "2019-06%" AND  pending = 2
		// GROUP BY i.item_type_id

    	return $service_list;
    }
}
