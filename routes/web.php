<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, enctype');
header('Access-Control-Allow-Methods: GET, PATCH, POST, DELETE');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/', 'UserController@index');
    Route::get('/logout', 'UserController@logout');
    Route::get('/user', 'UserController@getAuthUser');
    Route::post('/changePassword', 'UserController@changePassword');

    ///Route Sparepart
    Route::get('/sparepart', 'SparepartController@index');
    Route::get('/sparepart/{kode_sparepart}', 'SparepartController@show');
    Route::post('/sparepart', 'SparepartController@store');
    Route::post('/sparepart/{kode_sparepart}', 'SparepartController@update');
    Route::delete('/sparepart/{kode_sparepart}', 'SparepartController@destroy');

});

Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');

});


