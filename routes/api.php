<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function(){
	Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
	Route::post('me', 'AuthController@me')->middleware('jwt');
});

Route::apiResource('/businesses', 'BusinessController');

Route::group(['middleware' => 'jwt'], function(){

	Route::apiResource('/staffs', 'StaffController');
	Route::get('/receptionists', 'StaffController@getReceptionists');
	Route::get('/service_engineers', 'StaffController@getServiceEngineers');
	Route::put('/staffs/{staff}/changeAccount','StaffController@changeAccount');
	Route::put('/staffs/{staff}/changeSecret','StaffController@changeSecret');
	
	Route::apiResource('roles', 'RoleController');

	Route::apiResource('states', 'StateController');

	Route::apiResource('departments', 'DepartmentController');

	Route::apiResource('services', 'ServiceController');

	Route::apiResource('customers', 'CustomerController');

	Route::post('/service-item', 'ServiceItemController@store');
    Route::delete('/service-item/{id}', 'ServiceItemController@destroy');
     
	Route::get('/states/{state}/townships', 'StateController@getTownships');
	Route::get('/townships/{township}/blocks', 'AddressController@getBlocks');
	Route::get('/departments/{department}/roles', 'DepartmentController@getRoles');

	Route::apiResource('brands', 'BrandController');
	Route::apiResource('itemtypes', 'Item\ItemTypeController');
	Route::apiResource('brands.itemtypes', 'BrandItemTypeController', ['only' => ['index']]);
	Route::apiResource('models', 'ModelController');

	// Route::apiResource('items', 'Item\ItemController');

	// Route::apiResource('attributes', 'Item\AttributeController');

	// Route::apiResource('attributevalues', 'Item\AttributeValueController');


});