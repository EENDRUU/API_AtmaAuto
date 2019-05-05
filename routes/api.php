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

///Route Jasa Service
Route::get('/jasaService', 'JasaServiceController@index');
Route::get('/jasaService/{id}', 'JasaServiceController@show');
Route::post('/jasaService', 'JasaServiceController@store');
Route::post('/jasaService/{id}', 'JasaServiceController@update');
Route::delete('/jasaService/{id}', 'JasaServiceController@destroy');
