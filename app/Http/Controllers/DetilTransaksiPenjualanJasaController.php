<?php

namespace App\Http\Controllers;

use App\DetilTransaksiPenjualanJasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class DetilTransaksiPenjualanJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $detilTransaksiPenjualanJasa = DB::table('detail_transaksi_penjualanjasa')
        ->join('jasa','detail_transaksi_penjualanjasa.ID_JASA','=','jasa.ID_JASA')
        ->select('detail_transaksi_penjualanjasa.*','jasa.NAMAJASA')
        ->get();
        return $detilTransaksiPenjualanJasa;
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

        $detil = new DetilTransaksiPenjualanJasa();
        $detil->ID_DETAILPENJUALANJASA = $request->ID_DETAILPENJUALANJASA;
        $detil->NOMOR_TRANSAKSI = $request->NOMOR_TRANSAKSI;
        $detil->ID_JASA = $request->ID_JASA;
        $detil->JUMLAHJASA = $request->JUMLAHJASA;
        $detil->SUBTOTALJASA = $request->SUBTOTALJASA;
        $detil->NOMORPOLISI = $request->NOMORPOLISI;
        $detil->STATUS = $request->STATUS;

        $saved =  $detil->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $detil,
                'message' => 'Success Adding Detil Transaksi Penjualan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding Detil Transaksi Penjualan'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetilTransaksiPenjualanJasa  $detilTransaksiPenjualanJasa
     * @return \Illuminate\Http\Response
     */
    public function show($NOMOR_TRANSAKSI)
    {
        $detil = DB::table('detail_transaksi_penjualanjasa')
        ->join('jasa','detail_transaksi_penjualanjasa.ID_JASA','=','jasa.ID_JASA')
        ->select('detail_transaksi_penjualanjasa.*','jasa.NAMAJASA')
        ->where('detail_transaksi_penjualanjasa.NOMOR_TRANSAKSI','=',$NOMOR_TRANSAKSI)
        ->get();
        if(sizeof($detil)==0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, detil with NOMOR_TRANSAKSI: ' . $NOMOR_TRANSAKSI . ' cannot be found'
            ]);
        }
        else{
            return response()->json($detil,200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetilTransaksiPenjualanJasa  $detilTransaksiPenjualanJasa
     * @return \Illuminate\Http\Response
     */
    public function edit(DetilTransaksiPenjualanJasa $NOMOR_TRANSAKSI)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetilTransaksiPenjualanJasa  $detilTransaksiPenjualanJasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_DETAILPENJUALANJASA)
    {
        $detil = DetilTransaksiPenjualanJasa::find($ID_DETAILPENJUALANJASA);
        if(is_null($detil))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Penjualan Jasa : ' . $ID_DETAILPENJUALANJASA . ' cannot be found'
            ]);
        }

        $updated = $detil->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $detil,
                'message' => 'Detil Transaksi Penjualan updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Penjualan could not be updated'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetilTransaksiPenjualanJasa  $detilTransaksiPenjualanJasa
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_DETAILPENJUALANJASA)
    {
        $detil = DetilTransaksiPenjualanJasa::find($ID_DETAILPENJUALANJASA);
        if(is_null($detil))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Penjualan: ' . $ID_DETAILPENJUALANJASA . ' cannot be found'
            ]);
        }

        $success=$detil->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi penjualan could not be deleted'
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
