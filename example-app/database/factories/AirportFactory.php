<?php

namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    protected $model = Airport::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city() . ' International Airport',
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
        ];
    }
}
