<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    use HasFactory;

    protected $fillable = [
        'terminal',
        'gate_number',
        'status',
        'active',
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
