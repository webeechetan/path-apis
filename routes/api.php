<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubTestController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

 

//signup routes
Route::post('/signup', [AuthController::class, 'signup']);

//login routes
Route::post('/login', [AuthController::class, 'login']);



// Patient routes

Route::post('/patients', [PatientController::class, 'store']);
Route::get('/patients', [PatientController::class, 'index'])->middleware('auth:sanctum');
Route::delete('/patients/{patient}', [PatientController::class, 'destroy']);
Route::put('/patients/{patient}', [PatientController::class, 'update']);

Route::get('/patients/{patient:name}', [PatientController::class, 'show'])->missing(function () {
    return response()->json([
        'success' => false ,
        'message' => 'Patient not found', 
        'data' => null
    ], 404);
});


// doctors routes
Route::get('/doctors', [UserController::class, 'listDoctors']);
Route::post('/doctors', [UserController::class, 'storeDoctor']);
Route::delete('/doctors/{user}', [UserController::class, 'destroyDoctor']);


// other users routes
Route::get('/users', [UserController::class, 'listUsers']);
Route::post('/users', [UserController::class, 'storeUser']);
Route::delete('/users/{user}', [UserController::class, 'destroyUser']);



Route::group(['middleware' => 'auth:sanctum'], function(){
    // test routes
    Route::post('/tests', [TestController::class, 'store']);
    Route::get('/tests', [TestController::class, 'index']);
    Route::delete('/tests/{test}', [TestController::class, 'destroy']);
    Route::put('/tests/{test}', [TestController::class, 'update']);
    
    // Subtest routes
    Route::post('/sub-tests', [SubTestController::class, 'store']);
    Route::get('/sub-tests', [SubTestController::class, 'index']);
    Route::delete('/sub-tests/{subtest}', [SubTestController::class, 'destroy']);
    Route::put('/sub-tests/{subtest}', [SubTestController::class, 'update']);
});


