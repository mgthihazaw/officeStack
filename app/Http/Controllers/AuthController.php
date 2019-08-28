<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
   
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
      
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Username or password incorrect','type' => 'login_fail'], 401);
    }
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    public function user(Request $request)
    {
        $staff = Staff::find(Auth::user()->id);
        
        return response()->json([
            'status' => 'success',
            'data' => $staff,
            
        ]);
    }
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    private function guard()
    {
        return Auth::guard();
    }

    public function me()
    {
        
        $permissions = [];
        foreach($this->guard()->user()->roles as $role){
            foreach($role->perms as $permission){
                $permissions[] = $permission->name;
            }
        }

        $roles = [];
        foreach($this->guard()->user()->roles as $role){
            $roles[] = $role->name;
        }
        return response()->json([
            'user' => [
                'id' => $this->guard()->id(),
                'username' => $this->guard()->user()->username,
                'roles' => $roles,
                'permissions' => $permissions,
            ]
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => [
                'id'    => $this->guard()->id(),
                'username' => $this->guard()->user()->username,
                //'roles' => $roles,
                //'permissions' => $permissions,
            ],
            
            'expires_in' => auth()->factory()->getTTL()
        ]);
    }

    
}
