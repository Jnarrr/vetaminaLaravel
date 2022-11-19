<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $customeruser = new CustomerUser;
        $customeruser -> username = $req -> input('username');
        $customeruser -> birthdate = $req -> input('birthdate');
        $customeruser -> password = Hash::make($req -> input('password'));
        $customeruser -> email = $req -> input('email');
        $customeruser -> mobile_number = $req -> input('mobile_number');
        $customeruser -> save();
        $data = [
            'status' => 201,
            'customeruser' => $customeruser
        ];

        return $customeruser->toJson();
    }

    function customerlogin(Request $req){
        $customeruser = CustomerUser::where('username',$req->username)->first();
        if(!$customeruser || !Hash::check($req->password,$customeruser->password)){
            return ["error"=>"Username or Password is not matched"];
        }
        return $customeruser;
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
    public function edit(CustomerUser $customerUser)
    {
        //
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
