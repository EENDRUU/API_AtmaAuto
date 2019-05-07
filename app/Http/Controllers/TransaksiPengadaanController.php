<?php

namespace App\Http\Controllers;

use App\TransaksiPengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class TransaksiPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransaksiPengadaan::all();
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

        $pemesanan = new TransaksiPengadaan();
        $pemesanan->ID_PESANAN = $request->ID_PESANAN;
        $pemesanan->ID_SUPPLIER = $request->ID_SUPPLIER;
        $pemesanan->TANGGALPEMESANAN = $request->TANGGALPEMESANAN;
        $pemesanan->TOTALBIAYAPEMESANAN = $request->STATUS;

        $saved =  $pemesanan->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $pemesanan,
                'message' => 'Success Adding Transaksi Pemesanan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding Transaksi Pemesanan'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransaksiPengadaan  $transaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function show($id_pesanan)
    {
        $pemesanan = TransaksiPengadaan::find($id_pesanan);
        if(is_null($pemesanan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Pemesanan with nama: ' . $id_pesanan . ' cannot be found'
            ]);
        }
        else{
            return response()->json($pemesanan,200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransaksiPengadaan  $transaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiPengadaan $transaksiPengadaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransaksiPengadaan  $transaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pesanan)
    {
        $pemesanan = TransaksiPengadaan::find($id_pesanan);
        if(is_null($pemesanan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Pemesanan with nama: ' . $id_pesanan . ' cannot be found'
            ]);
        }

        $updated = $pemesanan->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $pemesanan,
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
     * @param  \App\TransaksiPengadaan  $transaksiPengadaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pesanan)
    {
        $pemesanan = TransaksiPengadaan::find($id_pesanan);
        if(is_null($pemesanan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Pemesanan with nama: ' . $id_pesanan . ' cannot be found'
            ]);
        }

        $success=$pemesanan->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Transaksi Pemesanan could not be deleted'
            ], 500);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $pemesanan,
                'message' => 'Transaksi Pemesanan Deleted'
            ]);
        }
    }
}
