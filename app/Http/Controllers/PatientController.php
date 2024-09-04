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
    public function  index(Request $request)
    {
        $test  = $request->query('test');
        $amount = $request->query('amount');

        if ($test) {
            $patients = Patient::where('test', $test)->get();
            return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
        }

        if ($amount) {
            $patients = Patient::where('amount', $amount)->get();
            return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
        }

        $patients = Patient::all();

        return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
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

        $patient->name = $input['name'];
        $patient->test = $input['test'];
        $patient->amount = $input['amount'];
        $patient->save();

        return $this->sendResponse($patient->toArray(), 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return $this->sendResponse($patient->toArray(), 'Patient deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Patient not found.');
        }
    }
}
