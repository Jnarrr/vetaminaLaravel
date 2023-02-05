<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\MailMessage;
use App\Models\CustomerUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    function customerregister(Request $req){
        $otp = rand(100000,999999); //add

        $customeruser = new CustomerUser;
        $customeruser -> username = $req -> input('username');
        $customeruser -> password = Hash::make($req -> input('password'));
        $customeruser -> email = $req -> input('email');
        $customeruser -> mobile_number = $req -> input('mobile_number');
        $customeruser -> otp = $otp; //add
        $customeruser -> save();

        /*$data = [
            'status' => true,
            'customeruser' => $customeruser
        ];*/

        $email = $req->input('email');

        if($customeruser){
            Mail::to($email)->send(new MailMessage($email, $otp)); // add $otp
            return new JsonResponse(
                [
                    'status' => true,
                    'customeruser' => $customeruser,
                    'message' => 'Thank you for registering your account, Please check your inbox'
                ], 201
            );
        }

        //return response()->json($data, 201);
    }

    public function resendOTP(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:191',
            'otp' => 'required|max:191'
        ]);

        if ($validator->fails()){
            return new JsonResponse(
                [
                    'success' => false, 
                    'message' => $validator->errors() 
                ], 422);
        }

        $otp = rand(100000,999999); //add
        $email = $req->input('email');

        $user = CustomerUser::where([['email','=',$request->email],['otp','=',$request->otp]])->first();
        if($user){
            Mail::to($email)->send(new MailMessage($email, $otp)); // add $otp
            CustomerUser::where('email','=',$request->email)->update(['otp' => $otp]);
        }
    }

    public function verifyEmail(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:191',
            'otp' => 'required|max:191'
        ]);

        if ($validator->fails()){
            return new JsonResponse(
                [
                    'success' => false, 
                    'message' => $validator->errors() 
                ], 422);
        }

        $user = CustomerUser::where([['email','=',$request->email],['otp','=',$request->otp]])->first();
        if($user){
            CustomerUser::where('email','=',$request->email)->update(['otp' => '000000', 'is_verified' => 'true']);

            return response(["status" => 200, "message" => "Success"]);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }

    function customerlogin(Request $req){
        $customeruser = CustomerUser::where('email',$req->email)->first();
        if(!$customeruser || !Hash::check($req->password,$customeruser->password)){
            return ["error"=>"Email address or Password is not matched"];
        }
        if($customeruser && Hash::check($req->password,$customeruser->password) && !($customeruser->is_verified == "true")){
            $otp = rand(100000,999999); //add
            $email = $req->email;
            Mail::to($email)->send(new MailMessage($email, $otp)); // add $otp
            CustomerUser::where('email','=',$req->email)->update(['otp' => $otp]);
            return ["notVerified"=>"User is not yet verified"];
        }
        return $customeruser;
    }

    public function userSearch($key)
    {
        return CustomerUser::where('id', 'Like', "%$key%")->get();
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
     * @param  \App\Models\CustomerUser  $customerUser
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerUser $customerUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerUser  $customerUser
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $customeruser = CustomerUser::find($id);
        if($customeruser)
        {
            return response()->json([
                'status'=> 200,
                'customeruser' => $customeruser,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No User ID Found',
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerUser  $customerUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'password'=>'required|max:191',
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
            $customeruser = CustomerUser::find($id);
            if($customeruser)
            {
                $customeruser->password = Hash::make($request->input('password'));
                $customeruser->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Password Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No User ID Found',
                ]);
            }
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'username'=>'required|max:191',
            'email'=>'required|max:191',
            'mobile_number'=>'required|max:191',
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
            $customeruser = CustomerUser::find($id);
            if($customeruser)
            {
                $customeruser->username = $request->input('username');
                $customeruser->email = $request->input('email');
                $customeruser->mobile_number = $request->input('mobile_number');
                $customeruser->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Profile Information Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Customer User ID Found',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerUser  $customerUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerUser $customerUser)
    {
        //
    }
}
