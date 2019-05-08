<?php

namespace App\Http\Controllers;

use App\DetilTransaksiPengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class DetilTransaksiPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DetilTransaksiPengadaan::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $detil = new DetilTransaksiPengadaan();
        $detil->ID_DETILPEMESANAN = $request->ID_DETILPEMESANAN;
        $detil->ID_PESANAN = $request->ID_PESANAN;
        $detil->KODE_SPAREPART = $request->KODE_SPAREPART;
        $detil->HARGABELISPAREPART = $request->HARGABELISPAREPART;
        $detil->SATUAN = $request->SATUAN;
        $detil->JUMLAH = $request->JUMLAH;
        $detil->SUBTOTALPEMESANAN = $request->SUBTOTALPEMESANAN;

        $saved =  $detil->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $detil,
                'message' => 'Success Adding Detil Transaksi Pemesanan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding Detil Transaksi Pemesanan'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetilTransaksiPengadaan  $detilTransaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function show($ID_PESANAN)
    {
        $detil = DetilTransaksiPengadaan::where('ID_PESANAN',$ID_PESANAN)->get();
        if(sizeof($detil)==0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, supplier with id pesanan: ' . $ID_PESANAN . ' cannot be found'
            ]);
        }
        else{
            return response()->json($detil,200);

        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetilTransaksiPengadaan  $detilTransaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function edit(DetilTransaksiPengadaan $detilTransaksiPengadaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetilTransaksiPengadaan  $detilTransaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_detilPemesanan)
    {
        $detil = DetilTransaksiPengadaan::find($id_detilPemesanan);
        if(is_null($detil))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Pemesanan with nama: ' . $id_detilPemesanan . ' cannot be found'
            ]);
        }

        $updated = $detil->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $detil,
                'message' => 'Detil Transaksi Pemesanan updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Pemesanan could not be updated'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetilTransaksiPengadaan  $detilTransaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_detilPemesanan)
    {
        $detil = DetilTransaksiPengadaan::find($id_detilPemesanan);
        if(is_null($detil))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Pemesanan with nama: ' . $id_detilPemesanan . ' cannot be found'
            ]);
        }

        $success=$detil->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Pemesanan could not be deleted'
            ], 500);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $detil,
                'message' => 'Detil Transaksi Pemesanan Deleted'
            ]);
        }
    }
}
