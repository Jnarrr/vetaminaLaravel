<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clinic_id)
    {
        $employees = Employee::where('clinic_id', $clinic_id)->get();
        return response()->json([
            'status'=> 200,
            'employees'=>$employees,
        ]);
    }

    public function employeelogin(Request $req){
        $employeeuser = Employee::where('employee_email',$req->employee_email)->first();
        if(!$employeeuser || !Hash::check($req->employee_password,$employeeuser->employee_password)){
            return ["error"=>"Email or Password is not matched"];
        }
        return $employeeuser;
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
            'employee_name'=>'required|max:191',
            'employee_email'=>'required|email|max:191',
            'employee_phone_number'=>'required|max:191',
            'employee_password'=>'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/|max:191',
        ], ['employee_password.regex' => 'The password should contain atleast 1 digit, special, and Uppercase Character']
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
            $employee = new Employee;
            $employee->clinic_id = $request->input('clinic_id');
            $employee->employee_name = $request->input('employee_name');
            $employee->employee_email = $request->input('employee_email');
            $employee->employee_phone_number = $request->input('employee_phone_number');
            $employee->employee_password = Hash::make($request->input('employee_password'));
            $employee->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Employee Added Successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        if($employee)
        {
            return response()->json([
                'status'=> 200,
                'employee' => $employee,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'employee_name'=>'required|max:191',
            'employee_email'=>'required|max:191',
            'employee_phone_number'=>'required|max:191',
            'employee_password'=>'required|max:191',
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
            $employee = Employee::find($id);
            if($employee)
            {
                $employee->employee_name = $request->input('employee_name');
                $employee->employee_email = $request->input('employee_email');
                $employee->employee_phone_number = $request->input('employee_phone_number');
                $employee->employee_password = Hash::make($request->input('employee_password'));
                $employee->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Employee Updated Successfully',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if($employee)
        {
            $employee->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Employee Deleted Successfully',
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
