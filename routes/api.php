<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Patient routes

Route::post('/patients', [PatientController::class, 'store']);
Route::get('/patients', [PatientController::class, 'index']);
Route::get('/patients/{name}', [PatientController::class, 'show'])->missing(function () {
    return response()->json([
        'success' => false ,
        'message' => 'Patient not found', 
        'data' => null
    ], 404);
});


Route::post('/doctors', [doctorController::class, 'store']);
Route::get('/doctors', [doctorController::class, 'index']);