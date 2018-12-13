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
    'prefix' => 'auth'
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
          Route::post('create_Owner_Vehicle', 'OwnerController@create_Owner_Vehicle');
          Route::get('getAll_OwnerVehicle', 'OwnerController@getAll_OwnerVehicle');         
    });

});