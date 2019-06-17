<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Person;
use App\Location;
use App\Address;
use App\Http\Resources\StaffResource;
use Auth;
use Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StaffResource::collection(Staff::all());
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
        
        $request->validate([
            'address.block' => 'required|string',
            'address.home_no' => 'required|string',
            'address.street' => 'required|string',
            'address.township' => 'required',
            'address.state.id' => 'required',
            'name' => 'required',
            'username' => 'required|string|unique:staffs',
            'password' => 'required|string',
            'phone' => 'required|string',
            'role' => 'required|integer',
            'business' => 'required|integer',
            'department' => 'required|integer',
        ]);
   
        $address = $request->address;

        $block = $address['block'];
        $home_no = $address['home_no'];
        $street = $address['street'];

        $township = $address['township']; // township object

        $state = $address['state']; // state object
        
        if(is_array($township)){
            $location = Location::firstOrCreate([
                'name' => $township['name'],
                'location_id' => $state['id'],
            ]);
        }else{
            $location = Location::firstOrCreate([
                'name' => $township,
                'location_id' => $state['id'],
            ]);
        }

        $staff_address = Address::firstOrCreate([
            'home_no' => $home_no,
            'block' => $block,
            'street' => $street,
            'location_id' => $location->id,
        ]);

        $name = $request->name;
        $business_id = $request->business;
        $department_id = $request->department;
        $phone = $request->phone;

        $role = $request->role;

        $person = Person::firstOrCreate([
            'name' => $name,
            'address_id' => $staff_address->id,
            'phone' => $phone,
            'person_business_id' => 2,
        ]);

        Staff::firstOrCreate([
            'person_business_id' => $person->id,
            'role_id' => $role,
            'business_id' => $business_id,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return response()->json('Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);

        return new StaffResource($staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        //return response()->json($request->all());
        $request->validate([
            'address.block' => 'required',
            'address.home_no' => 'required',
            'address.street' => 'required',
            'address.township' => 'required',
            'address.state.id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'business' => 'required',
            'department' => 'required',
        ]);

        $old_staff = Staff::findOrFail($id);

        $name = $request->name;
        $phone = $request->phone;
        $role = $request->role;
        $business = $request->business;
        $block = $request->address['block'];
        $home_no = $request->address['home_no'];
        $street = $request->address['street'];

        $state = $request->address['state']['id'];

        $new_township = $request->address['township'];
        if(is_array($new_township)){
            $township = Location::where('name', '=' ,$new_township['name'])->where('location_id', '=' , $state)->first();
        }else{
            $township = Location::where('name', '=' ,$new_township)->where('location_id', '=' , $state)->first();
        }

        if(!$township){
            if(is_array($new_township)){
                $township = Location::firstOrCreate([
                    'name' => $new_township['name'],
                    'location_id' => $state,
                ]);
            }else{
                $township = Location::firstOrCreate([
                    'name' => $new_township,
                    'location_id' => $state,
                ]);
            }
        }

        $staff_address = Address::firstOrCreate([
            'home_no' => $home_no,
            'block' => $block,
            'street' => $street,
            'location_id' => $township->id,
        ]);


        $old_staff->person_business->name = $name;
        $old_staff->person_business->phone = $phone;
        $old_staff->person_business->save();

        $old_staff->business_id = $business;
        $old_staff->role_id = $role;
        $old_staff->save();

        $old_staff->person_business->address_id = $staff_address->id;
        $old_staff->person_business->save();
        
        return response()->json($old_staff);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);

        $person = $staff->person_business;

        $person->delete();
        return response('Successfully Deleted', 204);
    }


    public function getReceptionists(){
        $receptionists = StaffResource::collection(Staff::receptionists()->get());
        return response()->json($receptionists, 200);
    }

    public function getServiceEngineers(){
        $service_engineers = StaffResource::collection(Staff::serviceEngineers()->get());

        return response()->json($service_engineers, 200);
    }
    public function changeAccount(Staff $staff,Request $request)
    {
        $request->validate([
            'newPassword' => 'required|confirmed|string|min:6',
            'oldPassword' =>'required'
        ]);
        
        if(Hash::check($request->oldPassword,$staff->password)){
            
            $staff->password=bcrypt($request->newPassword);
            
                $staff->save();
                return response()->json("Successfully change Account",200);
            
        }
        return response()->json("Your Account is invalid",403);
    }
    public function changeSecret(Staff $staff,Request $request){
        
        $request->validate([
            'newSecret' => 'required|confirmed|string|min:6',
            'password' =>'required'
        ]);
        if(Hash::check($request->password,$staff->password)){
            
            $staff->secret=bcrypt($request->newSecret);
            
                $staff->save();
                return response()->json("Successfully change Account",200);
            
        }
        return response()->json("Your Account is invalid",403);
    
    }
}
