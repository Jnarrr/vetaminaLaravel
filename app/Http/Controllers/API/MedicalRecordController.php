<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pet_id)
    {
        $medicalrecords = MedicalRecord::where('pet_id', $pet_id)->get();
        return response()->json([
            'status'=> 200,
            'medical_records'=>$medicalrecords,
        ]);
    }

    public function showAll()
    {
        $medicalrecords = MedicalRecord::all();
        return response()->json([
            'status'=> 200,
            'medical_records'=>$medicalrecords,
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
            'pet_id'=>'required|max:100',
            'Date'=>'required|max:100',
            'Weight'=>'required|max:100',
            'Against_Manufacturer_LotNo'=>'required|max:100',
            'vet_name'=>'required|max:100',
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
            $medicalrecord = new MedicalRecord;
            $medicalrecord->pet_id = $request->input('pet_id');
            $medicalrecord->Date = $request->input('Date');
            $medicalrecord->Weight = $request->input('Weight');
            $medicalrecord->Against_Manufacturer_LotNo = $request->input('Against_Manufacturer_LotNo');
            $medicalrecord->vet_name = $request->input('vet_name');
            $medicalrecord->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Medical Record Added Successfully',
            ]);
        }
    }

    public function search($key)
    {
        return MedicalRecord::where('pet_id', 'Like', "%$key%")->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicalrecord = MedicalRecord::find($id);
        if($medicalrecord)
        {
            return response()->json([
                'status'=> 200,
                'medical_records' => $medicalrecord,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Medical Record ID Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'Date'=>'required|max:100',
            'Weight'=>'required|max:100',
            'Against_Manufacturer_LotNo'=>'required|max:100',
            'vet_name'=>'required|max:100',
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
            $medicalrecord = MedicalRecord::find($id);
            if($medicalrecord)
            {
                $medicalrecord->Date = $request->input('Date');
                $medicalrecord->Weight = $request->input('Weight');
                $medicalrecord->Against_Manufacturer_LotNo = $request->input('Against_Manufacturer_LotNo');
                $medicalrecord->vet_name = $request->input('vet_name');
                $medicalrecord->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Medical Record Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Medical Record ID Found',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalrecord = MedicalRecord::find($id);
        if($medicalrecord)
        {
            $medicalrecord->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Medical Record Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Medical Record ID Found',
            ]);
        }
    }
}
