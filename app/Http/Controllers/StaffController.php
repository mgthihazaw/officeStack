<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Person;
use App\Township;
use App\Address;
use App\Http\Resources\StaffResource;
use App\Http\Requests\Staff\StaffStoreRequest;
use App\Http\Requests\Staff\StaffUpdateRequest;

use DB;
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
        return StaffResource::collection(Staff::where('id', '<>',1)->paginate(10));
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
    public function store(StaffStoreRequest $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $username = $request->username;
        $password = $request->password;
        $role_id = $request->role;
        $business_id = $request->business;

        $state_id = $request->state;
        $township = $request->township;
        $address_line = $request->address_line;

        DB::beginTransaction();
        try{
            $township = Township::firstOrCreate([
                'name' => $township,
                'state_id' => $state_id
            ]);

            $person = Person::create([
                'name' => $name,
                'phone' => $phone,
                'address_line' => $address_line,
                'township_id' => $township->id,
                'person_business_id' => 2
            ]);

            $staff = Staff::create([
                'person_business_id' => $person->id,
                'business_id' => $business_id,
                'username' => $username,
                'password' => bcrypt($password)
            ]);

            $staff->attachRole($role_id);
            
            DB::commit();

            return response()->json(['data' => new StaffResource($staff)], 201);
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::endTransaction();     
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
    public function update(StaffUpdateRequest $request, Staff $staff)
    {
        $name = $request->name;
        $phone = $request->phone;
        $username = $request->username;
        $password = $request->password;
        $role_id = $request->role;
        $business_id = $request->business;

        $state_id = $request->state;
        $township = $request->township;
        $address_line = $request->address_line;

        DB::beginTransaction();
        try{
            $township = Township::firstOrCreate([
                'name' => $township,
                'state_id' => $state_id
            ]);

            $person = $staff->person_business;
            $person->update([
                'name' => $name,
                'phone' => $phone,
                'address_line' => $address_line,
                'township_id' => $township->id
            ]);
            
            $staff->business_id = $business_id;
            $staff->username = $username;
            if($request->password){
                $staff->password = bcrypt($request->password);
            }
            $staff->save();

            $staff->roles()->sync($role_id);
            
            DB::commit();

            return response()->json(['data' => new StaffResource($staff)], 201);
        }catch(Exception $e){
            DB::rollback();
            dd($e);
        }
        DB::endTransaction(); 
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
            'newPassword' => 'required|min:6|confirmed',
            'oldPassword' =>'required'
        ]);
        
        if(Hash::check($request->oldPassword,$staff->password)){
            
            $staff->password=bcrypt($request->newPassword);
            
                $staff->save();
                return response()->json("Successfully change Account",200);
            
        }
        return response()->json(["error" => "Your Account is invalid"],403);
    }
    public function changeSecret(Staff $staff,Request $request){
        
        $request->validate([
            'newSecret' => 'required|min:6|confirmed',
            'password' =>'required'
        ]);
        if(Hash::check($request->password,$staff->password)){
            
            $staff->secret=bcrypt($request->newSecret);
            
                $staff->save();
                return response()->json("Successfully change Account",200);
            
        }
        return response()->json(["error" => "Your Account is invalid"],403);
    
    }
}
