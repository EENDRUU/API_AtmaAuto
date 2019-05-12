<?php

namespace App\Http\Controllers;

use App\KendaraanPelanggan;
use Illuminate\Http\Request;

class KendaraanPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraanPelanggan = DB::table('kendaraankonsumen')
        ->join('tipekendaraan','kendaraankonsumen.IDTIPE','=','tipekendaraan.IDTIPE')
        ->join('merekkendaraan','kendaraankonsumen.IDMEREK','=','merekkendaraan.IDMEREK')
        ->select('kendaraankonsumen.*','tipekendaraan.NAMATIPE','merekkendaraan.NAMAMEREK')
        ->get();
        return KendaraanPelanggan::all();
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
        $kendaraanPelanggan = new KendaraanPelanggan();
        $kendaraanPelanggan->NOMORPOLISI = $request->NOMORPOLISI;
        $kendaraanPelanggan->IDMEREK = $request->IDMEREK;
        $kendaraanPelanggan->IDTIPE = $request->IDTIPE;

        $saved =  $kendaraanPelanggan->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $kendaraanPelanggan,
                'message' => 'Success Adding kendaraan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding kendaraan'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KendaraanPelanggan  $kendaraanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(KendaraanPelanggan $kendaraanPelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KendaraanPelanggan  $kendaraanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(KendaraanPelanggan $kendaraanPelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KendaraanPelanggan  $kendaraanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KendaraanPelanggan $kendaraanPelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KendaraanPelanggan  $kendaraanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KendaraanPelanggan $kendaraanPelanggan)
    {
        //
    }
}
