<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Airplane;
use App\Models\Flight;

class Airline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'country',
        'status',
    ];

    public function airplanes()
    {
        return $this->hasMany(Airplane::class);
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}

