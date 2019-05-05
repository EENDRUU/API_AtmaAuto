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
    Route::get('/sparepart/{KODE_SPAREPART}', 'SparepartController@show');
    Route::post('/sparepart', 'SparepartController@store');
    Route::post('/sparepart/{KODE_SPAREPART}', 'SparepartController@update');
    Route::delete('/sparepart/{KODE_SPAREPART}', 'SparepartController@destroy');

    ///Route Supplier
    Route::get('/supplier', 'SupplierController@index');
    Route::get('/supplier/{NAMASUPPLIER}', 'SupplierController@show');
    Route::post('/supplier', 'SupplierController@store');
    Route::post('/supplier/{ID_SUPPLIER}', 'SupplierController@update');
    Route::delete('/supplier/{ID_SUPPLIER}', 'SupplierController@destroy');



});

Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');

});


