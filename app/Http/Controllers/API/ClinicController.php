<?php

namespace App\Http\Controllers\API;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::where('verified', 'false')->get();
        return response()->json([
            'status'=> 200,
            'clinics'=>$clinics,
        ]);
    }

    public function index2()
    {
        $clinics2 = Clinic::where('verified', 'true')->get();
        return response()->json([
            'status'=> 200,
            'clinics2'=>$clinics2,
        ]);
    }

    public function showOneClinic($clinic_id)
    {
        $oneClinic = Clinic::where('verified', 'true')
        ->where('id', $clinic_id)
        ->get();
        return response()->json([
            'status'=> 200,
            'oneClinic'=>$oneClinic,
        ]);
    }

    public function list()
    {
        return Clinic::all();
    }

    public function cliniclogin(Request $req){
        $clinicuser = Clinic::where('username',$req->username)->first();
        if(!$clinicuser || !Hash::check($req->password,$clinicuser->password)){
            return ["error"=>"Email or Password is not matched"];
        }
        if($clinicuser && Hash::check($req->password,$clinicuser->password) && !($clinicuser->verified == "true")){
            return ["notVerified"=>"User is not yet verified"];
        }
        return $clinicuser;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username'=>'required|unique:clinics,username|max:191',
            'password'=>'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/|max:191',
            'registration_number'=>'required|max:191',
            'owner_name'=>'required|max:191',
            'clinic_name'=>'required|max:191',
            'phone_number'=>'required|max:191',
            'address'=>'required|max:191',
            'email'=>'required|email|max:191',
            'permit'=>'required|image|mimes:jpeg,png,jpg|max:8192',
            'verified'=>'required|max:191',
        ], ['password.regex' => 'The password should contain atleast 1 digit, special, and Uppercase Character']
        );

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
            $clinic->password = Hash::make($request->input('password'));
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
            'verified'=>'required|max:191',
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
                $clinic->verified = $request->input('verified');
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