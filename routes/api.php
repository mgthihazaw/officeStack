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

Route::group(['middleware' => 'jwt'], function(){
	Route::apiResource('businesses', 'BusinessController');
	Route::apiResource('businesses.departments', 'Business\BusinessDepartmentController', ['only' => ['index']]);

	Route::apiResource('staffs', 'StaffController');
	Route::get('/receptionists', 'StaffController@getReceptionists');
	Route::get('/service_engineers', 'StaffController@getServiceEngineers');
	Route::put('/staffs/{staff}/changeAccount','StaffController@changeAccount');
	Route::put('/staffs/{staff}/changeSecret','StaffController@changeSecret');
	
	Route::apiResource('roles', 'RoleController');

	Route::apiResource('states', 'StateController');

	Route::apiResource('departments', 'DepartmentController');

	Route::apiResource('services', 'Service\ServiceController');
	Route::apiResource('services.items', 'Service\ServiceItemController', ['only' => ['index','store']]);

	Route::apiResource('customers', 'CustomerController');

	Route::post('/service-item', 'ServiceItemController@store');
    Route::delete('/service-item/{id}', 'ServiceItemController@destroy');
     
	Route::get('/states/{state}/townships', 'StateController@getTownships');
	Route::get('/townships/{township}/blocks', 'AddressController@getBlocks');
	Route::get('/departments/{department}/roles', 'DepartmentController@getRoles');

	Route::apiResource('brands', 'Brand\BrandController');
	Route::apiResource('brands.itemtypes', 'Brand\BrandItemTypeController', ['only' => ['index']]);

	Route::apiResource('itemtypes', 'Item\ItemTypeController');
	Route::apiResource('itemtypes.attributegroups', 'Item\ItemTypeAttributeGroupController', ['only' => ['index', 'store']]);
	Route::apiResource('itemtypes.brands', 'ItemType\ItemTypeBrandController', ['only' => ['index']]);


	Route::apiResource('attributegroups', 'AttributeGroup\AttributeGroupController');
	Route::apiResource('attributegroups.attributes', 'AttributeGroup\AttributeGroupAttributeController', ['only' => ['index']]);

	Route::get('/search/attribute', 'Attribute\AttributeController@search');

	Route::apiResource('items', 'Item\ItemController');
	Route::get('search/items', 'Item\ItemController@search');
});