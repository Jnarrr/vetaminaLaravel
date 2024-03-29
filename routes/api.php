<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClinicController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\API\PetController;
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\VeterinaryController;
use App\Http\Controllers\API\CustomerUserController;
use App\Http\Controllers\API\MedicalRecordController;
use App\Http\Controllers\API\ReportController;

Route::get('clinics', [ClinicController::class, 'index']);
Route::get('clinics2', [ClinicController::class, 'index2']);
Route::get('oneClinic/{id}', [ClinicController::class, 'showOneClinic']);
Route::post('/add-clinic', [ClinicController::class, 'store']);
Route::get('/edit-clinic/{id}', [ClinicController::class, 'edit']);
Route::put('update-clinic/{id}', [ClinicController::class, 'update']);
Route::delete('delete-clinic/{id}', [ClinicController::class, 'destroy']);
Route::get('list', [ClinicController::class, 'list']);
Route::post('cliniclogin', [ClinicController::class, 'cliniclogin']);

Route::get('all-products', [ProductController::class, 'showAllProducts']);
Route::get('products/{id}', [ProductController::class, 'index']);
Route::post('/add-product', [ProductController::class, 'store']);
Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
Route::put('update-product/{id}', [ProductController::class, 'update']);
Route::delete('delete-product/{id}', [ProductController::class, 'destroy']);

Route::get('services/{id}', [ServiceController::class, 'index']);
Route::post('/add-service', [ServiceController::class, 'store']);
Route::get('/edit-service/{id}', [ServiceController::class, 'edit']);
Route::put('update-service/{id}', [ServiceController::class, 'update']);
Route::delete('delete-service/{id}', [ServiceController::class, 'destroy']);

Route::get('employees/{id}', [EmployeeController::class, 'index']);
Route::post('/add-employee', [EmployeeController::class, 'store']);
Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit']);
Route::put('update-employee/{id}', [EmployeeController::class, 'update']);
Route::delete('delete-employee/{id}', [EmployeeController::class, 'destroy']);
Route::post('employeelogin', [EmployeeController::class, 'employeelogin']);

Route::get('veterinaries/{id}', [VeterinaryController::class, 'index']);
Route::delete('delete-vet/{id}', [VeterinaryController::class, 'destroy']);
Route::post('/add-vet', [VeterinaryController::class, 'store']);
Route::get('/edit-vet/{id}', [VeterinaryController::class, 'edit']);
Route::put('update-vet/{id}', [VeterinaryController::class, 'update']);
Route::post('vetlogin', [VeterinaryController::class, 'vetlogin']);

/*Route::post('vetregister', [VetController::class, 'vetregister']);
Route::post('vetlogin', [VetController::class, 'vetlogin']);*/

Route::post('customerregister', [CustomerUserController::class, 'customerregister']);
Route::post('customerlogin', [CustomerUserController::class, 'customerlogin']);
Route::get('getUser/{id}', [CustomerUserController::class, 'edit']);
Route::put('update-customeruser/{id}', [CustomerUserController::class, 'update']);
Route::get('userSearch/{id}', [CustomerUserController::class, 'userSearch']);
Route::put('update-profile/{id}', [CustomerUserController::class, 'updateProfile']);
Route::post('verifyEmail', [CustomerUserController::class, 'verifyEmail']);

Route::get('pets/{id}', [PetController::class, 'index']);
Route::get('onePet/{id}', [PetController::class, 'onePet']);
Route::get('recentPet/{id}', [PetController::class, 'recentPet']);
Route::post('add-pets', [PetController::class, 'store']);
Route::get('/edit-pets/{id}', [PetController::class, 'edit']);
Route::put('update-pets/{id}', [PetController::class, 'update']);

Route::get('appointments/{id}', [AppointmentController::class, 'index']);
Route::get('recentAppointment/{id}', [AppointmentController::class, 'recentAppointment']);
Route::get('/edit-appointment/{id}', [AppointmentController::class, 'edit']);
Route::put('update-appointment/{id}', [AppointmentController::class, 'update']);
Route::get('ClinicAppointments/{id}', [AppointmentController::class, 'index2']);
Route::delete('delete-appointment/{id}', [AppointmentController::class, 'destroy']);
Route::post('add-appointments', [AppointmentController::class, 'store']);
Route::get('appointmentsCount/{id}', [AppointmentController::class, 'appointmentCount']);
Route::get('approvedAppointmentCount/{id}', [AppointmentController::class, 'approvedAppointmentCount']);
Route::get('ApprovedAppointments/{id}', [AppointmentController::class, 'ApprovedAppointments']);
Route::get('appointmentCurrentMonthCount/{id}', [AppointmentController::class, 'appointmentCurrentMonthCount']);
Route::get('appointmentServiceCount/{id}', [AppointmentController::class, 'appointmentServiceCount']);
Route::get('appointmentSearch/{id}/{key}', [MedicalRecordController::class, 'search']);

Route::get('medicalrecord/{id}', [MedicalRecordController::class, 'index']);
Route::get('medicalrecordAll', [MedicalRecordController::class, 'showAll']);
Route::post('add-medicalrecord/{id}', [MedicalRecordController::class, 'store']);
Route::get('/edit-medicalrecord/{id}', [MedicalRecordController::class, 'edit']);
Route::put('update-medicalrecord/{id}', [MedicalRecordController::class, 'update']);
Route::delete('delete-medicalrecord/{id}', [MedicalRecordController::class, 'destroy']);
Route::get('search/{id}/{key}', [MedicalRecordController::class, 'search']);
Route::get('medicalReport/{id}', [MedicalRecordController::class, 'medicalReport']);
Route::get('medicalrecordCurrentMonthCount/{id}', [MedicalRecordController::class, 'medicalrecordCurrentMonthCount']);

Route::post('add-report', [ReportController::class, 'addReport']);
Route::get('get-report/{id}', [ReportController::class, 'getReport']);




