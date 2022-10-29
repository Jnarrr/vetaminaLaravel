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
use App\Http\Controllers\API\CustomerUserController;

Route::get('clinics', [ClinicController::class, 'index']);
Route::get('clinics2', [ClinicController::class, 'index2']);
Route::post('/add-clinic', [ClinicController::class, 'store']);
Route::get('/edit-clinic/{id}', [ClinicController::class, 'edit']);
Route::put('update-clinic/{id}', [ClinicController::class, 'update']);
Route::delete('delete-clinic/{id}', [ClinicController::class, 'destroy']);
Route::get('list', [ClinicController::class, 'list']);
Route::post('cliniclogin', [ClinicController::class, 'cliniclogin']);

Route::get('products/{id}', [ProductController::class, 'index']);
Route::post('/add-product', [ProductController::class, 'store']);
Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
Route::put('update-product/{id}', [ProductController::class, 'update']);
Route::delete('delete-product/{id}', [ProductController::class, 'destroy']);

Route::get('services', [ServiceController::class, 'index']);
Route::post('/add-service', [ServiceController::class, 'store']);
Route::get('/edit-service/{id}', [ServiceController::class, 'edit']);
Route::put('update-service/{id}', [ServiceController::class, 'update']);
Route::delete('delete-service/{id}', [ServiceController::class, 'destroy']);

Route::get('employees', [EmployeeController::class, 'index']);
Route::post('/add-employee', [EmployeeController::class, 'store']);
Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit']);
Route::put('update-employee/{id}', [EmployeeController::class, 'update']);
Route::delete('delete-employee/{id}', [EmployeeController::class, 'destroy']);

Route::post('vetregister', [VetController::class, 'vetregister']);
Route::post('vetlogin', [VetController::class, 'vetlogin']);

Route::post('customerregister', [CustomerUserController::class, 'customerregister']);
Route::post('customerlogin', [CustomerUserController::class, 'customerlogin']);

Route::get('pets', [PetController::class, 'index']);
Route::post('pets', [PetController::class, 'store']);

Route::get('appointments', [AppointmentController::class, 'index']);
Route::post('appointments', [AppointmentController::class, 'store']);