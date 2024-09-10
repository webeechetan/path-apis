<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubTest;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'test',
    ];

    public function subTests()
    {
        return $this->hasMany(SubTest::class);
    }
}
