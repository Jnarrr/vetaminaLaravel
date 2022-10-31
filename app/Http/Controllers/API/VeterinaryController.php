<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Veterinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VeterinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clinic_id)
    {
        $veterinaries = Veterinary::where('clinic_id', $clinic_id)->get();
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
        $validator = Validator::make($request->all(),[
            'clinic_id'=>'required|max:191',
            'vet_name'=>'required|max:191',
            'vet_email'=>'required|max:191',
            'vet_phone_number'=>'required|max:191',
            'vet_password'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        }
        else
        {
            $vet = new Veterinary;
            $vet->clinic_id = $request->input('clinic_id');
            $vet->vet_name = $request->input('vet_name');
            $vet->vet_email = $request->input('vet_email');
            $vet->vet_phone_number = $request->input('vet_phone_number');
            $vet->vet_password = $request->input('vet_password');
            $vet->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Veterinary Added Successfully',
            ]);
        }
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
    public function edit($id)
    {
        $vet = Veterinary::find($id);
        if($vet)
        {
            return response()->json([
                'status'=> 200,
                'vet' => $vet,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Veterinary ID Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Veterinary  $veterinary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'vet_name'=>'required|max:191',
            'vet_email'=>'required|max:191',
            'vet_phone_number'=>'required|max:191',
            'vet_password'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }
        else
        {
            $vet = Veterinary::find($id);
            if($vet)
            {
                $vet->vet_name = $request->input('vet_name');
                $vet->vet_email = $request->input('vet_email');
                $vet->vet_phone_number = $request->input('vet_phone_number');
                $vet->vet_password = $request->input('vet_password');
                $vet->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Veterinary Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Veterinary ID Found',
                ]);
            }
        }
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
