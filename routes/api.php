<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClinicController;
use App\Http\Controllers\VetController;

Route::get('clinics', [ClinicController::class, 'index']);
Route::post('/add-clinic', [ClinicController::class, 'store']);
Route::get('/edit-clinic/{id}', [ClinicController::class, 'edit']);
Route::put('update-clinic/{id}', [ClinicController::class, 'update']);
Route::delete('delete-clinic/{id}', [ClinicController::class, 'destroy']);

Route::post('vetregister', [VetController::class, 'vetregister']);