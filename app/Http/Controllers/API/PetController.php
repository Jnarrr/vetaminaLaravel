<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        /*
        $pet = Pet::all();

        $data = [
            'status' => true,
            'pets' => $pet
        ];

        return response()->json($data);*/

        $pet = Pet::where('user_id', $user_id)->get();
        return response()->json([
            'status'=> 200,
            'pets'=>$pet,
        ]);
    }

    public function onePet($id)
    {
        $pet = Pet::where('id', $id)->get();
        return response()->json([
            'status'=> 200,
            'pets'=>$pet,
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
        $pet = new Pet;

        $pet->user_id = $request->user_id;
        $pet->pet_name = $request->pet_name;
        $pet->pet_type = $request->pet_type;
        $pet->pet_sex = $request->pet_sex;
        $pet->pet_breed = $request->pet_breed;
        $pet->pet_birthdate = $request->pet_birthdate;
        $pet->pet_weight = $request->pet_weight;
        $pet->pet_description = $request->pet_description;

        $pet->save();

        $data = [
            'status' => true,
            'pet' => $pet
        ];

        return response()->json($data, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pet = Pet::find($id);
        if($pet)
        {
            return response()->json([
                'status'=> 200,
                'pet' => $pet,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Pet ID Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'pet_name'=>'required|max:191',
            'pet_type'=>'required|max:191',
            'pet_sex'=>'required|max:191',
            'pet_breed'=>'required|max:191',
            'pet_weight'=>'required|max:191',
            'pet_description'=>'required|max:191',
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
            $pet = Pet::find($id);
            if($pet)
            {
                $pet->pet_name = $request->pet_name;
                $pet->pet_type = $request->pet_type;
                $pet->pet_sex = $request->pet_sex;
                $pet->pet_breed = $request->pet_breed;
                $pet->pet_weight = $request->pet_weight;
                $pet->pet_description = $request->pet_description;
                $pet->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Pet Information Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Pet ID Found',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
