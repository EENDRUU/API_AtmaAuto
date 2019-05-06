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

    public function getSparepartStokKurang()
    {
        return Sparepart::whereColumn('STOK','<=','STOKMINIMAL')->get();
    }

    public function store(Request $request)
    {

        $gambar = $request->file('gambarSparepart');

        $sparepart = new Sparepart();
        $sparepart->KODE_SPAREPART = $request->KODE_SPAREPART;
        if($gambar!=null)
        {
            $extension = $gambar->getClientOriginalExtension();
            Storage::disk('public')->put($gambar->getFilename().'.'.$extension,  File::get($gambar));
            $sparepart->mime = $gambar->getClientMimeType();
            $sparepart->original_filename = $gambar->getClientOriginalName();
            $sparepart->filename = $gambar->getFilename().'.'.$extension;
        }
        $sparepart->HARGABELI = $request->HARGABELI;
        $sparepart->HARGAJUAL = $request->HARGAJUAL;
        $sparepart->KODETEMPAT = $request->KODETEMPAT;
        $sparepart->STOK = $request->STOK;
        $sparepart->STOKMINIMAL = $request->STOKMINIMAL;
        $sparepart->MEREK = $request->MEREK;
        $sparepart->TIPE = $request->TIPE;
        $sparepart->NAMASPAREPART = $request->NAMASPAREPART;
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

    public function show($KODE_SPAREPART)
    {
        $sparepart=Sparepart::find($KODE_SPAREPART);

        if(is_null($sparepart))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart with kode sparepart: ' . $KODE_SPAREPART . ' cannot be found'
            ]);
        }
        else
        {
            return response()->json($sparepart,200);
        }

    }

    public function update(Request $request, $KODE_SPAREPART)
    {
        $sparepart=Sparepart::find($KODE_SPAREPART);



        if(is_null($sparepart))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart with kode sparepart: ' . $KODE_SPAREPART . ' cannot be found'
            ]);
        }

        if(!is_null($request->KODE_SPAREPART))
        {
            $sparepart->KODE_SPAREPART = $request->KODE_SPAREPART;
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
        if(!is_null( $request->HARGABELI))
        {
            $sparepart->HARGABELI = $request->HARGABELI;
        }
        if(!is_null( $request->HARGAJUAL))
        {
            $sparepart->HARGAJUAL = $request->HARGAJUAL;
        }
        if(!is_null( $request->KODETEMPAT))
        {
            $sparepart->KODETEMPAT = $request->KODETEMPAT;
        }
        if(!is_null( $request->STOK))
        {
            $sparepart->STOK = $request->STOK;
        }
        if(!is_null( $request->STOKMINIMAL))
        {
            $sparepart->STOKMINIMAL = $request->STOKMINIMAL;
        }
        if(!is_null($request->MEREK))
        {
            $sparepart->MEREK = $request->MEREK;
        }
        if(!is_null($request->TIPE))
        {
            $sparepart->TIPE = $request->TIPE;
        }
        if(!is_null($request->NAMASPAREPART))
        {
            $sparepart->NAMASPAREPART = $request->NAMASPAREPART;
        }
        $updated = $sparepart->save();
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


    public function destroy($KODE_SPAREPART)
    {
        $sparepart=Sparepart::find($KODE_SPAREPART);
        if(is_null($sparepart))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sparepart with kode sparepart: ' . $KODE_SPAREPART . ' cannot be found'
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
