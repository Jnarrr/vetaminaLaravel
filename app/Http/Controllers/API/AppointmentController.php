<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

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
        $appointment = Appointment::where('clinic_id', $clinic_id)->get();
        return response()->json([
            'status'=> 200,
            'appointments'=>$appointment
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
        $appointment->procedure = $request->procedure;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->pet = $request->pet;

        $appointment->save();

        $data = [
            'status' => true,
            'appointment' => $appointment
        ];

        return response()->json($data, 201);
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
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
