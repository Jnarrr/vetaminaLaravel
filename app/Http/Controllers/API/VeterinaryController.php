<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Veterinary;
use Illuminate\Http\Request;

class VeterinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veterinaries = Veterinary::all();
        return response()->json([
            'status'=> 200,
            'veterinaries'=>$veterinaries,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Veterinary  $veterinary
     * @return \Illuminate\Http\Response
     */
    public function show(Veterinary $veterinary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Veterinary  $veterinary
     * @return \Illuminate\Http\Response
     */
    public function edit(Veterinary $veterinary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Veterinary  $veterinary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Veterinary $veterinary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Veterinary  $veterinary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veterinary = Veterinary::find($id);
        if($veterinary)
        {
            $veterinary->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Veterinary Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Employee ID Found',
            ]);
        }
    }
}
