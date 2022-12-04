<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        // add $user_id parameter
        /*$appointment = Appointment::all();
        //$appointment = Appointment::where('user_id', $user_id)->get();

        $data = [
            'status' => true,
            'appointments' => $appointment
        ];

        return response()->json($data);*/
        $appointment = Appointment::where('user_id', $user_id)->get();
        return response()->json([
            'status'=> 200,
            'appointments'=>$appointment
        ]);
    }

    public function index2($clinic_id)
    {
        // add $user_id parameter
        /*$appointment = Appointment::all();
        //$appointment = Appointment::where('user_id', $user_id)->get();

        $data = [
            'status' => true,
            'appointments' => $appointment
        ];

        return response()->json($data);*/
        $appointment = Appointment::where('clinic_id', $clinic_id)
        ->orderBy('time', 'asc')
        ->orderBy('date', 'asc')
        ->get();
        return response()->json([
            'status'=> 200,
            'appointments'=>$appointment
        ]);
    }

    public function recentAppointment($user_id)
    {
        $appointment = Appointment::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->limit(1)
        ->get();
        return response()->json([
            'status'=> 200,
            'appointments'=>$appointment
        ]);
    }

    public function appointmentCount($clinic_id)
    {
        $appointment = Appointment::where('clinic_id', $clinic_id)->where('status', 'Waiting for Approval')->get();
        return response()->json([
            'status'=> 200,
            'appointmentsCount'=> $appointment->count()
        ]);
    }

    public function approvedAppointmentCount($clinic_id)
    {
        $appointment = Appointment::where('clinic_id', $clinic_id)->where('status', 'Approved')->get();
        return response()->json([
            'status'=> 200,
            'appointmentsCount'=> $appointment->count()
        ]);
    }

    public function appointmentCurrentMonthCount($clinic_id)
    {
        $appointment = Appointment::whereMonth('created_at', Carbon::now()->month)
        ->where('clinic_id', $clinic_id)
        ->get();
        
        return response()->json([
            'status'=> 200,
            'appointmentCurrentMonthCount'=> $appointment->count()
        ]);
    }

    public function appointmentServiceCount($clinic_id)
    {
        $vaccine = Appointment::whereMonth('created_at', Carbon::now()->month)
        ->where('clinic_id', "$clinic_id")
        ->where('procedure', 'Like', "%Vaccine%")
        ->get();
        $grooming = Appointment::whereMonth('created_at', Carbon::now()->month)
        ->where('clinic_id', "$clinic_id")
        ->where('procedure', 'Like', "%Grooming%")
        ->get();
        $surgery = Appointment::whereMonth('created_at', Carbon::now()->month)
        ->where('clinic_id', "$clinic_id")
        ->where('procedure', 'Like', "%Surgery%")
        ->get();
        $checkup = Appointment::whereMonth('created_at', Carbon::now()->month)
        ->where('clinic_id', "$clinic_id")
        ->where('procedure', 'Like', "%Checkup%")
        ->get();

        $vaccineCount = $vaccine->count();
        $groomingCount = $grooming->count();
        $surgeryCount = $surgery->count();
        $checkupCount = $checkup->count();

        $data = [
            $vaccineCount,
            $groomingCount,
            $surgeryCount,
            $checkupCount,
        ];

        return response()->json([
            'status'=> 200,
            'allproceduresCount'=> $data
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
        $appointment = new Appointment;

        $appointment->user_id = $request->user_id;
        $appointment->clinic_id = $request->clinic_id;
        $appointment->clinic_name = $request->clinic_name;
        $appointment->clinic_address = $request->clinic_address;
        $appointment->procedure = $request->procedure;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->pet = $request->pet;
        $appointment->status = $request->status;

        $appointment->save();

        return response()->json([
            'status'=> 200,
            'appointment'=>$appointment,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        if($appointment)
        {
            return response()->json([
                'status'=> 200,
                'appointment' => $appointment,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Apppointment ID Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'status'=>'required|max:191',
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
            $appointment = Appointment::find($id);
            if($appointment)
            {
                $appointment->status = $request->input('status');
                $appointment->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Product Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Product ID Found',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if($appointment)
        {
            $appointment->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Appointment Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Appointment ID Found',
            ]);
        }
    }
}
