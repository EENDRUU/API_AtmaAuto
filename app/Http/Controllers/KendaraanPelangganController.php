<?php

namespace App\Http\Controllers;

use App\KendaraanPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        return $kendaraanPelanggan;
    }

    public function getMerek()
    {
        $kendaraanPelanggan = DB::table('merekkendaraan')
        ->select('merekkendaraan.*')
        ->get();
        return $kendaraanPelanggan;
    }
    public function getTipe()
    {
        $kendaraanPelanggan = DB::table('tipekendaraan')
        ->select('tipekendaraan.*')
        ->get();
        return $kendaraanPelanggan;
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
    public function show($NOMORPOLISI)
    {
        $kendaraanPelanggan=KendaraanPelanggan::find($NOMORPOLISI);

        if(is_null($NOMORPOLISI))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, KendaraanPelanggan with kode NOMORPOLISI: ' . $NOMORPOLISI . ' cannot be found'
            ]);
        }
        else
        {
            return response()->json($kendaraanPelanggan,200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KendaraanPelanggan  $kendaraanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $NOMORPOLISI)
    {
        $kendaraanPelanggan=KendaraanPelanggan::find($NOMORPOLISI);
        if(is_null($kendaraanPelanggan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, kendaraanPelanggan with NOMORPOLISI : ' . $NOMORPOLISI  . ' cannot be found'
            ]);
        }

        $updated = $kendaraanPelanggan->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $kendaraanPelanggan,
                'message' => 'kendaraanPelanggan updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, kendaraanPelanggan could not be updated'
            ], 500);
        }
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
    public function destroy($NOMORPOLISI)
    {
        $kendaraanPelanggan=KendaraanPelanggan::find($NOMORPOLISI);
        if(is_null($kendaraanPelanggan))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, kendaraanPelanggan with NOMORPOLISI : ' . $NOMORPOLISI  . ' cannot be found'
            ]);
        }

        $success=$kendaraanPelanggan->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, kendaraanPelanggan could not be deleted'
            ], 500);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $kendaraanPelanggan,
                'message' => 'pegawai Deleted'
            ]);
        }
    }
}
