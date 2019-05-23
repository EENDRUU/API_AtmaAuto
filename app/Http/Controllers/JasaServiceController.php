<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JasaService;

class JasaServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jasa = JasaService::all();

        return response()->json($jasa,200);
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
        $string = str_random(4);
        $jasa = new JasaService;
        $jasa->ID_JASA = 'jas-'.$string;
        $jasa->NAMAJASA = $request->NAMAJASA;
        $jasa->HARGAJASA = $request->HARGAJASA;

        $success = $jasa->save();
        if(!$success){
            return response()->json('Error Add',500);
        }
        else
           return response()->json('Success',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ID_JASA
     * @return \Illuminate\Http\Response
     */
    public function show($ID_JASA)
    {
        $jasa = JasaService::find($ID_JASA);

        if(is_null($jasa)){
            return response()->json('Not Found',404);
        }
        else
            return response()->json($jasa,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ID_JASA
     * @return \Illuminate\Http\Response
     */
    public function edit($ID_JASA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ID_JASA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_JASA)
    {
        $jasa = JasaService::find($ID_JASA);

        if(!is_null($request->NAMAJASA)){
            $jasa->NAMAJASA = $request->NAMAJASA;
        }

        if(!is_null($request->HARGAJASA)){
            $jasa->HARGAJASA = $request->HARGAJASA;
        }

        $success = $jasa->save();

        if(!$success){
            return response()->json('Eror Updating',500);
        }
        else
            return response()->json('Success',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ID_JASA
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_JASA)
    {
        $jasa = JasaService::find($ID_JASA);

        if(is_null($jasa)){
            return response()->json('Not Found',404);
        }

        $success = $jasa->delete();

        if(!$success){
            return response()->json('Error Deleting', 500);
        }
        else
            return response()->json('Success',200);
    }
}
