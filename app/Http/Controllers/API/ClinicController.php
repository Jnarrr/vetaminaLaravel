<?php

namespace App\Http\Controllers\API;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::all();
        return response()->json([
            'status'=> 200,
            'clinics'=>$clinics,
        ]);
    }

    public function list()
    {
        return Clinic::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username'=>'required|max:191',
            'password'=>'required|max:191',
            'registration_number'=>'required|max:191',
            'owner_name'=>'required|max:191',
            'clinic_name'=>'required|max:191',
            'phone_number'=>'required|max:191',
            'address'=>'required|max:191',
            'email'=>'required|email|max:191',
            'permit'=>'required|max:8000',
            'verified'=>'required|max:191',
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
            $clinic = new Clinic;
            $clinic->username = $request->input('username');
            $clinic->password = $request->input('password');
            $clinic->registration_number = $request->input('registration_number');
            $clinic->owner_name = $request->input('owner_name');
            $clinic->clinic_name = $request->input('clinic_name');
            $clinic->phone_number = $request->input('phone_number');
            $clinic->address = $request->input('address');
            $clinic->email = $request->input('email');
            $clinic->permit = $request->file('permit')->store('permit');
            $clinic->verified = $request->input('verified');
            $clinic->save();


            return response()->json([
                'status'=> 200,
                'message'=>'Clinic Added Successfully',
            ]);
        }

    }

    public function edit($id)
    {
        $clinic = Clinic::find($id);
        if($clinic)
        {
            return response()->json([
                'status'=> 200,
                'clinic' => $clinic,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Clinic ID Found',
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'address'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:10|min:10',
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
            $clinic = Clinic::find($id);
            if($clinic)
            {

                $clinic->name = $request->input('name');
                $clinic->address = $request->input('address');
                $clinic->email = $request->input('email');
                $clinic->phone = $request->input('phone');
                $clinic->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Clinic Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Clinic ID Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $clinic = Clinic::find($id);
        if($clinic)
        {
            $clinic->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Clinic Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Clinic ID Found',
            ]);
        }
    }
}