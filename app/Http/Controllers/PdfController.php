<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{

    public function today(){

       
        $patients = Patient::whereDate('created_at', Carbon::today())->with(['doctorDetails', 'refByDetails'])->get();

        $doctors_ids = $patients->pluck('doctor_id')->unique();

        $doctors = User::whereIn('id', $doctors_ids)->get();

        $doctors_data = [];

        foreach($doctors as $doctor){
            $doctor_data = [];
            $doctor_data['name'] = $doctor->name;
            $doctor_data['patients'] = $patients->where('doctor_id', $doctor->id)->count();
            $doctor_data['rcless'] = $patients->where('doctor_id', $doctor->id)->sum('rcless');
            $doctor_data['amount'] = $patients->where('doctor_id', $doctor->id)->sum('amount');
            $doctor_data['type'] = $doctor->type;
            $doctors_data[] = $doctor_data;
        }

        // return $doctors_data;
        
        $pdf = Pdf::loadView('todays-data', ['patients' => $patients,'doctors_data'=>$doctors_data]);
        $path = 'pdf/today/'. Carbon::today()->format('Y-m-d') . '.pdf';
        Storage::delete($path);
        Storage::put($path, $pdf->output());
        return $pdf->download('todays-data.pdf');

    }

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