<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Supplier::all();
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
         $string = str_random(8);
        $suppliers = new Supplier();
        $suppliers->ID_SUPPLIER='sup-'.$string;

        $suppliers->NAMASUPPLIER = $request->NAMASUPPLIER;
        $suppliers->ALAMATSUPPLIER = $request->ALAMATSUPPLIER;
        $suppliers->NAMASALES = $request->NAMASALES;
        $suppliers->NOMORTELEPON_SALES = $request->NOMORTELEPON_SALES;

        $saved =  $suppliers->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'data' => $suppliers,
                'message' => 'Success Adding Supplier'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed, Adding Supplier'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($NAMASUPPLIER)
    {
        $suppliers = Supplier::where('NAMASUPPLIER',$NAMASUPPLIER)->first();
        if(is_null($suppliers))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, supplier with nama: ' . $NAMASUPPLIER . ' cannot be found'
            ]);
        }
        else{
            return response()->json($suppliers,200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_SUPPLIER)
    {
        $suppliers = Supplier::find($ID_SUPPLIER);

        if(is_null($suppliers))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, supplier with ID_SUPPLIER : ' . $ID_SUPPLIER  . ' cannot be found'
            ]);
        }

        $updated = $suppliers->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $suppliers,
                'message' => 'Supplier updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, supplier could not be updated'
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_SUPPLIER )
    {
        $suppliers=Supplier::find($ID_SUPPLIER );
        if(is_null($suppliers))
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, supplier with ID_SUPPLIER : ' . $ID_SUPPLIER  . ' cannot be found'
            ]);
        }

        $success=$suppliers->delete();

        if(!$success)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, supplier could not be deleted'
            ], 500);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $suppliers,
                'message' => 'Supplier Deleted'
            ]);
        }
    }
}
