<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();

        return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
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
            'name' => 'required',
            'test' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $patient = Patient::create($input);

        return $this->sendResponse($patient->toArray(), 'Patient created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return $this->sendResponse($patient->toArray(), 'Patient retrieved successfully.');
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
        // $patient->update($request->validated());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        return response()->json([
            'message'=>'Patient Deleted',
            'Data'=>$patient->delete()
        ],200);

    }
}
