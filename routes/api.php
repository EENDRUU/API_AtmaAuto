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
Route::get('/jasaService/{ID_JASA}', 'JasaServiceController@show');
Route::post('/jasaService', 'JasaServiceController@store');
Route::post('/jasaService/{ID_JASA}', 'JasaServiceController@update');
Route::delete('/jasaService/{ID_JASA}', 'JasaServiceController@destroy');
Route::get('/getStok', 'SparepartController@getSparepartStokKurang');

Route::get('/konsumenSparepart', 'SparepartController@index');
Route::get('/sortByPrice', 'SparepartController@sortbyPrice');
Route::get('/sortByStok', 'SparepartController@sortbyStok');

Route::get('/riwayat/{NOMORPOLISI}/{NOMORTELEPON_KONSUMEN}', 'TransaksiPenjualanController@riwayatTransaksiKonsumen');

//laporan
Route::get('pengeluaranbulanan/{id}', 'LaporanController@pengeluaranBulanan');//->middleware('isAdmin');
Route::get('penjualanjasa/{bulan}/{tahun}', 'LaporanController@penjualanJasa');//->middleware('isAdmin');
// Route::get('pengeluaranbulanandesktop/{id}', 'LaporanController@pengeluaranBulananDesktop');//->middleware('isAdmin');
Route::get('pendapatanbulanan/{id}', 'LaporanController@pendapatanBulanan');//->middleware('isAdmin');
// Route::get('pendapatanbulanandesktop/{id}', 'LaporanController@pendapatanBulananDesktop');//->middleware('isAdmin');
Route::get('sparepartterlaris/{id}', 'LaporanController@sparepartTerlaris');//->middleware('isAdmin');
Route::get('sisastok/{barang}/{tahun}', 'LaporanController@sisaStok');//->middleware('isAdmin');
Route::get('pendapatantahunan', 'LaporanController@pendapatanTahunan');//->middleware('isAdmin');
