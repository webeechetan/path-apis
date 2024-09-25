<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/patient-factoy', function () {
    \App\Models\Patient::factory()->count(1000)->create();
    return 'Patients created successfully';
});
