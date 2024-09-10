<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

class SubTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'name',
        'price',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
