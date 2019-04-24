<?php

namespace App\Http\Controllers;

use App\Sparepart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class SparepartController extends Controller
{
    protected $user;

    public function index()
    {
        return Sparepart::all();
    }

    public function store(Request $request)
    {

        $gambar = $request->file('gambarSparepart');
        $extension = $gambar->getClientOriginalExtension();
        Storage::disk('public')->put($gambar->getFilename().'.'.$extension,  File::get($gambar));

        $sparepart = new Sparepart();
        $sparepart->kode_sparepart = $request->kode_sparepart;
        $sparepart->mime = $gambar->getClientMimeType();
        $sparepart->original_filename = $gambar->getClientOriginalName();
        $sparepart->filename = $gambar->getFilename().'.'.$extension;
        $sparepart->hargaBeli = $request->hargaBeli;
        $sparepart->hargaJual = $request->hargaJual;
        $sparepart->kodeTempat = $request->kodeTempat;
        $sparepart->stok = $request->stok;
        $sparepart->merek = $request->merek;
        $sparepart->tipe = $request->tipe;
        $sparepart->namaSparepart = $request->namaSparepart;
        $saved = $sparepart->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $sparepart,
                'message' => 'Success Adding Sparepart'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding Sparepart'
            ], 500);
        }

    }

    public function show($kode_sparepart)
    {
        $sparepart=Sparepart::find($kode_sparepart);

        if(is_null($sparepart))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart with kode sparepart: ' . $kode_sparepart . ' cannot be found'
            ]);
        }
        else
        {
            return response()->json($sparepart,200);
        }

    }

    public function update(Request $request, $kode_sparepart)
    {
        $sparepart=Sparepart::find($kode_sparepart);



        if(is_null($sparepart))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart with kode sparepart: ' . $kode_sparepart . ' cannot be found'
            ]);
        }

        if(!is_null($request->kode_sparepart))
        {
            $sparepart->kode_sparepart = $request->kode_sparepart;
        }
        if(!is_null($request->file('gambarSparepart')))
        {
            $gambar = $request->file('gambarSparepart');
            $extension = $gambar->getClientOriginalExtension();
            Storage::disk('public')->put($gambar->getFilename().'.'.$extension,  File::get($gambar));
            $sparepart->mime = $gambar->getClientMimeType();
            $sparepart->original_filename = $gambar->getClientOriginalName();
            $sparepart->filename = $gambar->getFilename().'.'.$extension;
        }
        if(!is_null( $request->hargaBeli))
        {
            $sparepart->hargaBeli = $request->hargaBeli;
        }
        if(!is_null( $request->hargaJual))
        {
            $sparepart->hargaJual = $request->hargaJual;
        }
        if(!is_null( $request->kodeTempat))
        {
            $sparepart->kodeTempat = $request->kodeTempat;
        }
        if(!is_null( $request->stok))
        {
            $sparepart->stok = $request->stok;
        }
        if(!is_null($request->merek))
        {
            $sparepart->merek = $request->merek;
        }
        if(!is_null($request->tipe))
        {
            $sparepart->tipe = $request->tipe;
        }
        if(!is_null($request->namaSparepart))
        {
            $sparepart->namaSparepart = $request->namaSparepart;
        }
        $saved = $sparepart->save();
        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $sparepart,
                'message' => 'Sparepart updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart could not be updated'
            ], 500);
        }
    }


    public function destroy($kode_sparepart)
    {
        $sparepart=Sparepart::find($kode_sparepart);
        if(is_null($sparepart))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart with kode sparepart: ' . $kode_sparepart . ' cannot be found'
            ]);
        }

        $success=$sparepart->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart could not be deleted'
            ], 500);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $sparepart,
                'message' => 'Sparepart Deleted'
            ]);
        }

    }

}
