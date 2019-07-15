<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Service;
use App\Customer;
use App\Http\Resources\ServiceResource;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Hash;
use App\Staff;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ServiceResource::collection(Service::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_name = $request->customer_name;
        $customer_phone = $request->customer_phone;
        $customer_address = $request->customer_address;
        $staff_id = $request->receive_staff;

        $description = $request->description;
        $remark = $request->remark;
        $customer_id = $request->customer_id;

        if($customer_id){
            $request->validate([
                'customer_id' => 'required|integer',
                'receive_staff' => 'required|integer',
                'description' => 'required|string',
                'remark' => 'required|string',
            ]);

            $service = Service::create([
                'customer_id' => $customer_id,
                'staff_id' => $staff_id,
                'description' => $description,
                'remark' => $remark,
            ]);
            $service->invoice()->create([
                'total_price' => $total_price,
                'invoiceable_id' => $service->id,
                'invoiceable_type' => get_class($service),
                'opened_date' => now()->format('Y-m-d'),
                'closed_date' => now()->format('Y-m-d')
            ]);
        }else{
            

            $request->validate([
                'customer_name' => 'required|string',
                'customer_phone' => 'required',
                'customer_address' => 'required|string',
                'receive_staff' => 'required|integer',
                'description' => 'required|string',
                'remark' => 'required|string',
            ]);

            $service = Service::create([
                'business_id' => auth()->user()->business->id,
                'customer_name' => $customer_name,
                'customer_phone' => $customer_phone,
                'customer_address' => $customer_address,
                'staff_id' => $staff_id,
                'received_description' => $description,
                'received_remark' => $remark,
                'received_date' => now(),
            ]);
            $service->invoice()->create([
                'total_price' => 0,
                'invoiceable_id' => $service->id,
                'invoiceable_type' => get_class($service),
                'opened_date' => now()->format('Y-m-d'),
                'closed_date' => now()->format('Y-m-d')
            ]);
        }

    
        return response()->json("New Service Added" , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ServiceResource(Service::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $service = Service::findOrFail($id);

        if($request->service_engineer){
            $request->validate([
                'service_description' => 'required|string',
                'service_remark' => 'required',
                'service_engineer' => 'required|integer',
            ]);

            $secret = $request->secret;
            $serviceEngineer = Staff::findOrFail($request->service_engineer);

            if(Hash::check($secret, $serviceEngineer->secret)){
                $service->update([
                    'service_description' => $request->service_description,
                    'service_remark' => $request->service_remark,
                    'service_engineer_id' => $request->service_engineer,
                    'pending' => 1,
                    'finished_date' => now(),
                ]);

                return response()->json('Service has been finished', 200);
            }else{
                return response()->json(['error' => 'Your secret is wrong'], 401);
            }
            
        }

        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required',
            'customer_address' => 'required|string',
            'receive_staff' => 'required|integer',
            'description' => 'required|string',
            'remark' => 'required|string',
        ]);

        $service->update([
            'staff_id'=>$request->receive_staff,
            'customer_name'=>$request->customer_name,
            'customer_phone'=>$request->customer_phone,
            'township'=>$request->customer_address,
            'description'=>$request->description,
            'remark'=>$request->remark,
        ]);
        return response()->json("Sevice Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::findOrFail($id)->delete();

        return response()->json("Successfully Deleted");
    }
}
