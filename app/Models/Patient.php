<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SubTest;
use App\Models\Test;

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
}
