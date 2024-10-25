<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
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
            $query = Patient::with('doctorDetails','refByDetails')->whereHas('doctorDetails', function ($q) use ($doctor_name) {
                $q->where('name',$doctor_name);
            });

            $patients = $query->get();
            return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
  
        }    
      
        // Filter by date
        if ($date) {
            $patients = Patient::with('doctorDetails','refByDetails')->whereDate('created_at', $date)->get();
            return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully.');
        }

        // Get all patients if no filters
        $patients = Patient::with('doctorDetails','refByDetails')->paginate(10);
        return $this->sendResponse($patients, 'Patients retrieved successfully.');
    }

    public function getByDoctor(User $user, $date = null)
    {
        $query = Patient::where('doctor_id', $user->id);
        if ($date) {
            $query->whereMonth('created_at', Carbon::parse($date)->month);
        }
        $total_commission = $query->sum('rcless');
        $total_amount = $query->sum('amount');
        $total_amount_paid = $query->sum('amount_paid');
        $total_amount_paid_online = $query->sum('amount_paid_online');
        $total_amount_paid_cash = $query->sum('amount_paid_cash');
        $total_amount_due = $query->sum('amount_due');
        // $patients = $query->get();
        

        $patients = $query->paginate(10);

        return $this->sendResponse(
            [
                'patients' => $patients->toArray(),
                'total_commission' => $total_commission,
                'total_amount' => $total_amount,
                'total_amount_paid' => $total_amount_paid,
                'total_amount_paid_online' => $total_amount_paid_online,
                'total_amount_paid_cash' => $total_amount_paid_cash,
                'total_amount_due' => $total_amount_due,
            ], 'Patients retrieved successfully.'
        );
    }
    public function getRefBy(User $user, $date = null)
    {
        $query = Patient::where('ref_by_id', $user->id);
        if ($date) {
            $query->whereMonth('created_at', Carbon::parse($date)->month);
        }
        $total_commission = $query->sum('rcless');
        $total_amount = $query->sum('amount');
        $total_amount_paid = $query->sum('amount_paid');
        $total_amount_paid_online = $query->sum('amount_paid_online');
        $total_amount_paid_cash = $query->sum('amount_paid_cash');
        $total_amount_due = $query->sum('amount_due');

        $patients = $query->paginate(10);

        return $this->sendResponse(
            [
                'patients' => $patients->toArray(),
                'total_commission' => $total_commission,
                'total_amount' => $total_amount,
                'total_amount_paid' => $total_amount_paid,
                'total_amount_paid_online' => $total_amount_paid_online,
                'total_amount_paid_cash' => $total_amount_paid_cash,
                'total_amount_due' => $total_amount_due,
            ], 'Patients retrieved successfully.'
        );
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
