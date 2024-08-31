<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\doctor;
use Illuminate\Support\Facades\Validator;

class doctorController extends Controller


{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = doctor::all();

        return $this->sendResponse($doctors->toArray(), 'Doctors retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
           'dr_name' => 'required',
            'ref_by' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $doctor = doctor::create($input);

        return $this->sendResponse($doctor->toArray(), 'Doctors created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(doctor $doctor)
    {
        return $this->sendResponse($doctor->toArray(), 'Doctor retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(doctor $doctor)
    {
        //
    }
}
