<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClinicController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\API\PetController;
use App\Http\Controllers\API\AppointmentController;

Route::get('clinics', [ClinicController::class, 'index']);
Route::post('/add-clinic', [ClinicController::class, 'store']);
Route::get('/edit-clinic/{id}', [ClinicController::class, 'edit']);
Route::put('update-clinic/{id}', [ClinicController::class, 'update']);
Route::delete('delete-clinic/{id}', [ClinicController::class, 'destroy']);

Route::post('vetregister', [VetController::class, 'vetregister']);
Route::post('vetlogin', [VetController::class, 'vetlogin']);

Route::get('pets', [PetController::class, 'index']);
Route::post('pets', [PetController::class, 'store']);

Route::get('appointments', [AppointmentController::class, 'index']);
Route::post('appointments', [AppointmentController::class, 'store']);