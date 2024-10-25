<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'doctor_id',
        'ref_by_id',
        'amount',
        'test',
        'amount_paid',
        'amount_paid_online',
        'amount_paid_cash',
        'amount_due',
        'rcless',
        'test_status',
        'test_delivery_date',
    ];

    public function doctorDetails()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function refByDetails()
    {
        return $this->belongsTo(User::class, 'ref_by_id');
    }

    // public static function getDoctorsForTadays(){
    //     $patients = Patient::whereDate('created_at', Carbon::today())->with(['doctorDetails', 'refByDetails'])->get();
    //     $doctors_ids = $patients->pluck('doctor_id')->unique();
    //     $doctors = User::whereIn('id', $doctors_ids)->get();
    //     return $doctors;
    // }
}
