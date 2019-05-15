<?php

namespace App\Http\Controllers;

use App\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TransaksiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksiPenjualan = DB::table('transaksi_penjualan')
        ->join('konsumen','transaksi_penjualan.ID_KONSUMEN','=','konsumen.ID_KONSUMEN')
        ->join('pegawai','transaksi_penjualan.ID_PEGAWAI','=','pegawai.ID_PEGAWAI')
        ->select('transaksi_penjualan.*','konsumen.NAMAKONSUMEN','pegawai.NAMA_PEGAWAI')
        ->get();
        return $transaksiPenjualan;
    }

    public function riwayatTransaksiKonsumen(Request $request)
    {
        $transaksiPenjualan = DB::table('transaksi_penjualan')
        ->join('detail_transaksi_penjualanjasa', 'transaksi_penjualan.NOMOR_TRANSAKSI','=', 'detail_transaksi_penjualanjasa.NOMOR_TRANSAKSI')
        ->join('konsumen','transaksi_penjualan.ID_KONSUMEN','=','konsumen.ID_KONSUMEN')
        ->select('transaksi_penjualan.*','detail_transaksi_penjualanjasa.*','konsumen.NAMAKONSUMEN')
        ->where('konsumen.NOMORTELEPON_KONSUMEN','=', $request->NOMORTELEPON_KONSUMEN)
        ->where('detail_transaksi_penjualanjasa.NOMORPOLISI','=',$request->NOMORPOLISI)
        ->get();
        return $transaksiPenjualan;
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

        $transaksiPenjualan = new TransaksiPenjualan();
        $transaksiPenjualan->NOMOR_TRANSAKSI = $request->NOMOR_TRANSAKSI;
        $transaksiPenjualan->ID_PEGAWAI = $request->ID_PEGAWAI;
        $transaksiPenjualan->ID_KONSUMEN = $request->ID_KONSUMEN;
        $transaksiPenjualan->STATUS_BAYAR = $request->STATUS_BAYAR;
        $transaksiPenjualan->DISKON = $request->DISKON;
        $transaksiPenjualan->TANGGALPENJUALAN = $request->TANGGALPENJUALAN;
        $transaksiPenjualan->TOTALTRANSAKSIPENJUALAN = $request->TOTALTRANSAKSIPENJUALAN;

        $saved =  $transaksiPenjualan->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $transaksiPenjualan,
                'message' => 'Success Adding Transaksi Penjualan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding Transaksi Penjualan'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show($NOMOR_TRANSAKSI)
    {
        $transaksiPenjualan = TransaksiPenjualan::find($NOMOR_TRANSAKSI);
        if(is_null($transaksiPenjualan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Pemesanan with nama: ' . $NOMOR_TRANSAKSI . ' cannot be found'
            ]);
        }
        else{
            return response()->json($transaksiPenjualan,200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiPenjualan $transaksiPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $NOMOR_TRANSAKSI)
    {
        $transaksiPenjualan = TransaksiPenjualan::find($NOMOR_TRANSAKSI);
        if(is_null($transaksiPenjualan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Pemesanan with nama: ' . $NOMOR_TRANSAKSI . ' cannot be found'
            ]);
        }

        $updated = $transaksiPenjualan->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $transaksiPenjualan,
                'message' => 'Transaksi Pemesanan updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Pemesanan could not be updated'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($NOMOR_TRANSAKSI)
    {
        $transaksiPenjualan = TransaksiPenjualan::find($NOMOR_TRANSAKSI);
        if(is_null($transaksiPenjualan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Penjualan with nama: ' . $NOMOR_TRANSAKSI . ' cannot be found'
            ]);
        }

        $success=$transaksiPenjualan->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Penjualan could not be deleted'
            ], 500);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $transaksiPenjualan,
                'message' => 'Transaksi penjualan Deleted'
            ]);
        }
    }
}
