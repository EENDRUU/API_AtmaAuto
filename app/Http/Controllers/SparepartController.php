<?php

namespace App\Http\Controllers;

use App\Sparepart;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class SparepartController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return Sparepart::all();
    }

    public function store(Request $request)
    {
        $sparepart = new Sparepart();
        $sparepart->kode_sparepart = $request->kode_sparepart;
        $sparepart->hargaBeli = $request->hargaBeli;
        $sparepart->hargaJual = $request->hargaJual;
        $sparepart->kodeTempat = $request->kodeTempat;
        $sparepart->stok = $request->stok;
        $sparepart->merek = $request->merek;
        $sparepart->tipe = $request->tipe;
        $sparepart->namaSparepart = $request->namaSparepart;
        $sparepart->save();

        return response()->json([
            'success' => true,
            'data' => $sparepart,
            'message' => 'Success Adding Sparepart'

        ], 200);
    }

    public function show($kode_sparepart)
    {
        $sparepart=Sparepart::find($kode_sparepart);
        if(is_null($sparepart))
        {
            return response()->json("not found",404);
        }
        return response()->json($sparepart,200);
    }

    public function update(Request $request, $kode_sparepart)
    {
        $sparepart=Sparepart::find($kode_sparepart);

        if (!$sparepart) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart with kode sparepart: ' . $kode_sparepart . ' cannot be found'
            ], 400);
        }

        $updated = $sparepart->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $sparepart
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be updated'
            ], 500);
        }
    }


    public function destroy($kode_sparepart)
    {
        $sparepart=Sparepart::find($kode_sparepart);
        if(is_null($sparepart))
        {
            return response()->json("not found",404);
        }

        $success=$sparepart->delete();

        if(!$success)
        {
            return response()->json("error deleting",500);
        }

        return response()->json("success",200);
    }

}
