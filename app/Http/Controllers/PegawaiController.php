<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pegawai::all();
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

        $pegawai = new Pegawai();
        $pegawai->ID_PEGAWAI = $request->ID_PEGAWAI;
        $pegawai->NAMA_PEGAWAI = $request->NAMA_PEGAWAI;
        $pegawai->NOMORTELEPON_PEGAWAI = $request->NOMORTELEPON_PEGAWAI;
        $pegawai->ALAMAT = $request->ALAMAT;
        $pegawai->GAJI = $request->GAJI;
        $pegawai->ID_ROLE = $request->ID_ROLE;
        $saved = $pegawai->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $pegawai,
                'message' => 'Success Adding pegawai'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding pegawai'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show($ID_PEGAWAI)
    {
        $pegawai=Pegawai::find($ID_PEGAWAI);

        if(is_null($pegawai))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pegawai with kode pegawai: ' . $ID_PEGAWAI . ' cannot be found'
            ]);
        }
        else
        {
            return response()->json($pegawai,200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_PEGAWAI)
    {
        $pegawai=Pegawai::find($ID_PEGAWAI);
        if(is_null($pegawai))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pegawai with ID_PEGAWAI : ' . $ID_PEGAWAI  . ' cannot be found'
            ]);
        }

        $updated = $pegawai->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $pegawai,
                'message' => 'pegawai updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pegawai could not be updated'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_PEGAWAI)
    {
        $pegawai=Pegawai::find($ID_PEGAWAI );
        if(is_null($pegawai))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pegawai with ID_PEGAWAI : ' . $ID_PEGAWAI  . ' cannot be found'
            ]);
        }

        $success=$pegawai->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pegawai could not be deleted'
            ], 500);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $pegawai,
                'message' => 'pegawai Deleted'
            ]);
        }
    }
}
