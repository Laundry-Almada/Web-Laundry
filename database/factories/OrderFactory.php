<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'laundry_id' => \App\Models\Laundry::factory(),
            'service_id' => \App\Models\Service::factory(),
            'status' => 'pending',
            'order_date' => $this->faker->date(),
            'barcode' => Str::random(10),
            'weight' => $this->faker->randomFloat(2, 0.5, 10.0),
            'total_price' => $this->faker->randomFloat(2, 10000, 100000),
        ];
    }
}
