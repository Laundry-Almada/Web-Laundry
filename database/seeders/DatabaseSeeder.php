<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a laundry for foreign key references
        $laundry = \App\Models\Laundry::factory()->create();

        // Create a service for foreign key references
        $service = \App\Models\Service::factory()->create();

        // Create a user (admin)
        $admin = \App\Models\User::factory()->create([
            'role' => 'admin',
            'laundry_id' => $laundry->id,
        ]);

        // Create a user (staff)
        $staff = \App\Models\User::factory()->create([
            'role' => 'staff',
            'laundry_id' => $laundry->id,
        ]);

        // Create a customer
        $customer = \App\Models\Customer::factory()->create();

        // Create orders for the customer
        \App\Models\Order::factory(5)->create([
            'customer_id' => $customer->id,
            'laundry_id' => $laundry->id,
            'service_id' => $service->id,
        ]);
    }
}
