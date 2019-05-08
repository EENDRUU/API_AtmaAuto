<?php

namespace App\Http\Controllers;

use App\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class KonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Konsumen::all();
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

        $konsumen = new Konsumen();
        $konsumen->ID_KONSUMEN = $request->ID_KONSUMEN;
        $konsumen->NAMAKONSUMEN = $request->NAMAKONSUMEN;
        $konsumen->ALAMATKONSUMEN = $request->ALAMATKONSUMEN;
        $konsumen->NOMORTELEPON_KONSUMEN = $request->NOMORTELEPON_KONSUMEN;

        $saved =  $konsumen->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $konsumen,
                'message' => 'Success Adding  Konsumen'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding  Konsumen'
            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function show(Konsumen $konsumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Konsumen $konsumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konsumen $konsumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konsumen $konsumen)
    {
        //
    }
}
