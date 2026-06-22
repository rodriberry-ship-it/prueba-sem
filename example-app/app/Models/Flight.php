<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Airline;
use App\Models\Airplane;
use App\Models\Gate;
use App\Models\Airport;
use App\Models\Passenger;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'airplane_id',
        'gate_departure_id',
        'gate_arrival_id',
        'code',
        'origin_id',
        'destination_id',
        'departure_time',
        'arrival_time',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function departureGate()
    {
        return $this->belongsTo(Gate::class, 'gate_departure_id');
    }

    public function arrivalGate()
    {
        return $this->belongsTo(Gate::class, 'gate_arrival_id');
    }

    public function origin()
    {
        return $this->belongsTo(Airport::class, 'origin_id');
    }

    public function destination()
    {
        return $this->belongsTo(Airport::class, 'destination_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
