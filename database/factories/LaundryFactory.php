<?php

namespace Database\Factories;

use App\Models\Laundry;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaundryFactory extends Factory
{
    protected $model = Laundry::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => 'active',
        ];
    }
}
