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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group([
    'prefix' => 'auth',
    'middleware' => 'cors'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'auth:api','scope:Admin'
      ], function() {
          //Owner
          Route::put('create_Owner_Vehicle', 'OwnerController@create_Owner_Vehicle');
          Route::get('getAll_OwnerVehicle', 'OwnerController@getAll_OwnerVehicle');

          //Vehicle
          Route::put('create_Vehicle', 'VehicleController@create_Vehicle');
          Route::get('getAll_Vehicles', 'VehicleController@getAll_Vehicles');    
          Route::patch('changeState_Vehicle', 'VehicleController@changeState_Vehicle');   
          
          //Group
          Route::put('create_Group', 'GroupController@create_Group');
          Route::get('getAll_Groups', 'GroupController@getAll_Groups');    
          Route::get('get_Vehicle_Group', 'GroupController@get_Vehicle_Group');
          Route::delete('remove_Vehicle_Group', 'GroupController@remove_Vehicle_Group');  
          Route::put('add_Vehicles', 'GroupController@add_Vehicles');  
          Route::get('getAll_Geofences_Group', 'GroupController@getAll_Geofences_Group');    
         

         
    });

});