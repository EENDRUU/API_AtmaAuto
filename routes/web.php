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
    Route::get('/getStok', 'SparepartController@getSparepartStokKurang');

    ///Route Supplier
    Route::get('/SupplierByID/{NAMASUPPLIER}', 'SupplierController@showByID');
    Route::get('/supplier', 'SupplierController@index');
    Route::get('/supplier/{NAMASUPPLIER}', 'SupplierController@show');
    Route::post('/supplier', 'SupplierController@store');
    Route::post('/supplier/{ID_SUPPLIER}', 'SupplierController@update');
    Route::delete('/supplier/{ID_SUPPLIER}', 'SupplierController@destroy');

    ///Route Transaksi Pemesanan
    Route::get('/transaksiPemesanan', 'TransaksiPengadaanController@index');
    Route::get('/transaksiPemesanan/{ID_PESANAN}', 'TransaksiPengadaanController@show');
    Route::post('/transaksiPemesanan', 'TransaksiPengadaanController@store');
    Route::post('/transaksiPemesanan/{ID_PESANAN}', 'TransaksiPengadaanController@update');
    Route::delete('/transaksiPemesanan/{ID_PESANAN}', 'TransaksiPengadaanController@destroy');

    ///Route Detil Transaksi Pemesanan
    Route::get('/detilTP', 'DetilTransaksiPengadaanController@index');
    Route::get('/detilTP/{ID_PESANAN}', 'DetilTransaksiPengadaanController@show');
    Route::post('/detilTP', 'DetilTransaksiPengadaanController@store');
    Route::post('/detilTP/{ID_DETILPEMESANAN}', 'DetilTransaksiPengadaanController@update');
    Route::delete('/detilTP/{ID_DETILPEMESANAN}', 'DetilTransaksiPengadaanController@destroy');
    Route::get('/getAllDetail/{ID_PESANAN}', 'DetilTransaksiPengadaanController@getAllDetail');

    ///Route Transaksi Penjualan
    Route::get('/transaksiPenjualan', 'TransaksiPenjualanController@index');
    Route::get('/transaksiPenjualan/{NOMOR_TRANSAKSI}', 'TransaksiPenjualanController@show');
    Route::post('/transaksiPenjualan', 'TransaksiPenjualanController@store');
    Route::post('/transaksiPenjualan/{NOMOR_TRANSAKSI}', 'TransaksiPenjualanController@update');
    Route::delete('/transaksiPenjualan/{NOMOR_TRANSAKSI}', 'TransaksiPenjualanController@destroy');

     ///Route Detil Transaksi Penjualan Jasa
     Route::get('/detilTJ', 'DetilTransaksiPenjualanJasaController@index');
     Route::get('/detilTJ/{NOMOR_TRANSAKSI}', 'DetilTransaksiPenjualanJasaController@show');
     Route::post('/detilTJ', 'DetilTransaksiPenjualanJasaController@store');
     Route::post('/detilTJ/{ID_DETAILPENJUALANJASA}', 'DetilTransaksiPenjualanJasaController@update');
     Route::delete('/detilTJ/{ID_DETAILPENJUALANJASA}', 'DetilTransaksiPenjualanJasaController@destroy');

      ///Route Detil Transaksi Penjualan Sparepart
      Route::get('/detilTS', 'DetilTransaksiPenjualanSparepartController@index');
      Route::get('/detilTS/{NOMOR_TRANSAKSI}', 'DetilTransaksiPenjualanSparepartController@show');
      Route::post('/detilTS', 'DetilTransaksiPenjualanSparepartController@store');
      Route::post('/detilTS/{ID_DETAILPENJUALANSPAREPART}', 'DetilTransaksiPenjualanSparepartController@update');
      Route::delete('/detilTS/{ID_DETAILPENJUALANSPAREPART}', 'DetilTransaksiPenjualanSparepartController@destroy');

      ///Route Jasa Service
    Route::get('/jasaService', 'JasaServiceController@index');
    Route::get('/jasaService/{ID_JASA}', 'JasaServiceController@show');
    Route::post('/jasaService', 'JasaServiceController@store');
    Route::post('/jasaService/{ID_JASA}', 'JasaServiceController@update');
    Route::delete('/jasaService/{ID_JASA}', 'JasaServiceController@destroy');


    ///Route Konsumen
    Route::get('/konsumen', 'KonsumenController@index');
    // Route::get('/supplier/{NAMASUPPLIER}', 'SupplierController@show');
    Route::post('/konsumen', 'KonsumenController@store');
    // Route::post('/supplier/{ID_SUPPLIER}', 'SupplierController@update');
    // Route::delete('/supplier/{ID_SUPPLIER}', 'SupplierController@destroy');

     ///Route Kendaraan Konsumen
     Route::get('/kendaraan', 'KendaraanPelangganController@index');
     // Route::get('/supplier/{NAMASUPPLIER}', 'SupplierController@show');
     Route::post('/kendaraan', 'KendaraanPelangganController@store');
     // Route::post('/supplier/{ID_SUPPLIER}', 'SupplierController@update');
     // Route::delete('/supplier/{ID_SUPPLIER}', 'SupplierController@destroy');


     //log
     Route::get('/log', 'LogController@index');
    Route::post('/log', 'LogController@store');

    //role
    Route::get('/role', 'RoleController@index');


    ///Route Pegawai
    Route::get('/pegawai', 'PegawaiController@index');
    Route::get('/pegawai/{ID_PEGAWAI}', 'PegawaiController@show');
    Route::post('/pegawai', 'PegawaiController@store');
    Route::post('/pegawai/{ID_PEGAWAI}', 'PegawaiController@update');
    Route::delete('/pegawai/{ID_PEGAWAI}', 'PegawaiController@destroy');

});

Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');

});


