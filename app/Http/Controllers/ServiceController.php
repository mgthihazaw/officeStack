<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Customer;
use App\Http\Resources\ServiceResource;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ServiceResource::collection(Service::all());
        return response()->json($services);
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
        if(!Gate::allows('create-service', Auth::guard()->user())){
            throw new AuthorizationException;
            // return response()->json('You are not allowed');
        }
        $customer_name = $request->customer_name;
        $customer_phone = $request->customer_phone;
        $customer_address = $request->customer_address;
        $staff_id = $request->receptionist;
        $service_engineer_id = $request->service_engineer;
        $description = $request->description;
        $remark = $request->remark;
        $customer_id = $request->customer_id;


        if($customer_id){
            Service::create([
                'customer_id' => $customer_id,
                'staff_id' => $staff_id,
                'service_engineer_id' => $service_engineer_id,
                'description' => $description,
                'remark' => $remark,
            ]);
        }else{
            Service::create([
                'customer_name' => $customer_name,
                'customer_phone' => $customer_phone,
                'township' => $customer_address,
                'staff_id' => $staff_id,
                'service_engineer_id' => $service_engineer_id,
                'description' => $description,
                'remark' => $remark,
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
        
        $service=Service::findOrFail($id);
        $service->update([
            'staff_id'=>$request->receptionist,
            'service_engineer_id'=>$request->service_engineer,
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
