<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatedpdf()
    {
        $patients = Patient::all();

        foreach($patients as $row){
            $doctor = User::find($row['doctor_id']) ?? "";
            $ref =  User::where("type",$row['ref_by_id'])->first() ?? "";
            $row['doctor_id']  = $doctor['name'] ?? ""; 
            $row['ref_by_id']  = $ref['name'] ?? ""; 
        }
            


        $data = [
            'title' => 'Patients List',
            'date' => date('m/d/Y'),
            'patients' => $patients, 
        ];


        $pdf = Pdf::loadView('generatedpdf', $data)
            ->setPaper('a4') 
            ->setOptions([
                'isRemoteEnabled' => true,
                'enable-javascript' => true,
                'enable-local-file-access' => true,
                'no-stop-slow-scripts' => true,
                'javascript-delay' => 1000,
            ]);

        return $pdf->download('Patients-list.pdf');
    }

    public function doctorpdf(User $user, $date = null)
    {
        $query = Patient::where('doctor_id', $user->id);
    
        if ($date) {
            $query->whereMonth('created_at', Carbon::parse($date)->month);
        }
    
        $doctors = User::where('type', '1')->get();
    
        $patients = $query->with(['doctor', 'refby'])->get();  

        $total_commission = $query->sum('rcless');
        $total_amount = $query->sum('amount');
        $total_amount_paid = $query->sum('amount_paid');
        $total_amount_paid_online = $query->sum('amount_paid_online');
        $total_amount_paid_cash = $query->sum('amount_paid_cash');
        $total_amount_due = $query->sum('amount_due');
    
        $patients = $query->paginate(10);
    
        $data = [
            'title' => 'Patients List',
            'date' => date('m/d/Y'),
            'doctor' => $doctors,
            'patients' => $patients,
            'total_commission' => $total_commission,
            'total_amount' => $total_amount,
            'total_amount_paid' => $total_amount_paid,
            'total_amount_paid_online' => $total_amount_paid_online,
            'total_amount_paid_cash' => $total_amount_paid_cash,
            'total_amount_due' => $total_amount_due,
        ];
    
        $pdf = Pdf::loadView('doctorpdf', $data)
            ->setPaper('a4')
            ->setOptions([
                'isRemoteEnabled' => true,
                'enable-javascript' => true,
                'enable-local-file-access' => true,
                'no-stop-slow-scripts' => true,
                'javascript-delay' => 1000,
            ]);
    
        return $pdf->download('Patients-list.pdf');
    }
    

}