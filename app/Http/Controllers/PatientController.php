<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctor_name = $request->query('dr_name');
        $date = $request->query('date');

        if ($doctor_name) {
            $query = Patient::whereHas('doctorDetails', function ($q) use ($doctor_name) {
                $q->where('name',$doctor_name);
            });

            $patients = $query->get();
            return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
  
        }    
      
        // Filter by date
        if ($date) {
            $patients = Patient::whereDate('created_at', $date)->get();
            return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
        }

        // Get all patients if no filters
        $patients = Patient::with('doctorDetails','refByDetails')->paginate(10);
        return $this->sendResponse($patients, 'Patients retrieved successfully.');
    }

    /**
     * Store a newly created patient.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'amount' => 'required',
            'test' => 'required',
            'ref_by_id' => 'required',
            'doctor_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $patient = Patient::create($input);

        return $this->sendResponse($patient->toArray(), 'Patient created successfully.');
    }

    /**
     * Display the specified patient.
     */
    public function show(Patient $patient)
    {
        return $this->sendResponse($patient->toArray(), 'Patient retrieved successfully.');
    }

    /**
     * Update the specified patient.
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
     * Remove the specified patient from storage.
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
