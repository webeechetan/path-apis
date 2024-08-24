<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'dr_name',
        'ref_by',
        'test',
        'amount',
        'amount_paid',
        'amount_paid_online',
        'amount_paid_cash',
        'amount_due',
        'rcless',
        'test_status',
        'test_delivery_date',
    ];
}
