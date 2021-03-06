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


Route::group(['prefix' => 'v1'], function()  //,'middleware' => 'auth:api'
{
    Route::post('/getAuthUser', [ 'as'=>'v1.getAuthUser','uses'=>'API\AlertSystemController@getAuthUser']);

    Route::post('/stations', [ 'as'=>'v1.stations','uses'=>'API\AlertSystemController@getStations']);

    Route::post('/station', [ 'as'=>'v1.station','uses'=>'API\AlertSystemController@getStation']);

    Route::get('/nets', [ 'as'=>'v1.nets','uses'=>'API\AlertSystemController@getNets']);

    Route::post('/alerts', [ 'as'=>'v1.alerts','uses'=>'API\AlertSystemController@getAlerts']);

    Route::get('/typeStation', [ 'as'=>'v1.typeStation','uses'=>'API\AlertSystemController@getTypeStation']);

    Route::post('/consultAlert', [ 'as'=>'v1.consultAlert','uses'=>'API\AlertSystemController@consultAlert']);

});
