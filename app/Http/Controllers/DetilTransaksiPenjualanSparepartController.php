<?php

namespace App\Http\Controllers;

use App\DetilTransaksiPenjualanSparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class DetilTransaksiPenjualanSparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DetilTransaksiPenjualanSparepart::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $detil = new DetilTransaksiPenjualanSparepart();
        $detil->ID_DETAILPENJUALANSPAREPART = $request->ID_DETAILPENJUALANSPAREPART;
        $detil->NOMOR_TRANSAKSI = $request->NOMOR_TRANSAKSI;
        $detil->KODE_SPAREPART = $request->KODE_SPAREPART;
        $detil->KODE_SPAREPART = $request->KODE_SPAREPART;
        $detil->JUMLAH = $request->JUMLAH;
        $detil->SUBTOTALSPAREPART = $request->SUBTOTALSPAREPART;


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
     * @param  \App\DetilTransaksiPenjualanSparepart  $detilTransaksiPenjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function show($NOMOR_TRANSAKSI)
    {
        $detil = DB::table('detail_transaksi_penjualanspar')
        ->join('sparepart','detail_transaksi_penjualanspar.KODE_SPAREPART','=','sparepart.KODE_SPAREPART')
        ->select('detail_transaksi_penjualanspar.*','sparepart.NAMASPAREPART')
        ->where('detail_transaksi_penjualanspar.NOMOR_TRANSAKSI','=',$NOMOR_TRANSAKSI)
        ->get();
        if(sizeof($detil)==0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Penjualan : ' . $NOMOR_TRANSAKSI . ' cannot be found'
            ]);
        }
        else{
            return response()->json($detil,200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetilTransaksiPenjualanSparepart  $detilTransaksiPenjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function edit(DetilTransaksiPenjualanSparepart $detilTransaksiPenjualanSparepart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetilTransaksiPenjualanSparepart  $detilTransaksiPenjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_DETAILPENJUALANSPAREPART)
    {
        $detil = DetilTransaksiPenjualanSparepart::find($ID_DETAILPENJUALANSPAREPART);
        if(is_null($detil))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi Pemesanan with nama: ' . $ID_DETAILPENJUALANSPAREPART . ' cannot be found'
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
     * @param  \App\DetilTransaksiPenjualanSparepart  $detilTransaksiPenjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_DETAILPENJUALANSPAREPART)
    {
        $detil = DetilTransaksiPenjualanSparepart::find($ID_DETAILPENJUALANSPAREPART);
        if(is_null($detil))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Detil Transaksi penjualan with nama: ' . $ID_DETAILPENJUALANSPAREPART . ' cannot be found'
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
