<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Laundries
        $streets = ['Merdeka', 'Sudirman', 'Gatot Subroto', 'Veteran', 'Slamet Riyadi', 'Urip', 'Yos Sudarso', 'Ahmad Yani', 'Diponegoro', 'Pahlawan'];

        for ($i = 0; $i < 10; $i++) {
            Laundry::create([
                'name' => 'Laundry ke-' . ($i + 1),
                'address' => 'Jl. ' . $streets[$i] . ' No. ' . rand(10, 99) . ', Surakarta',
                'phone' => '0812' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'email' => 'laundry' . ($i + 1) . '@laundry.com',
                'status' => $i % 2 === 0 ? 'active' : 'inactive'
            ]);
        }

        // Create Services for each Laundry
        $services = [
            [
                'name' => 'Kiloan',
                'description' => 'Layanan cuci per kilogram',
                'price' => 5000
            ],
            [
                'name' => 'Express',
                'description' => 'Layanan cuci cepat 3 jam',
                'price' => 10000
            ],
            [
                'name' => 'Satuan',
                'description' => 'Layanan cuci per pcs',
                'price' => 15000
            ],
            [
                'name' => 'Regular',
                'description' => 'Layanan cuci regular 24 jam',
                'price' => 7000
            ]
        ];

        foreach (Laundry::all() as $laundry) {
            foreach ($services as $service) {
                Service::create([
                    'laundry_id' => $laundry->id,
                    'name' => $service['name'],
                    'description' => $service['description'],
                    'price' => $service['price']
                ]);
            }
        }

        // Create Users
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password'),
                'role' => 'staff'
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'password' => Hash::make('password'),
                'role' => 'staff'
            ],
            [
                'name' => 'Ridlo',
                'email' => 'ridlo@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Create Customers
        $customers = [
            [
                'name' => 'Ahmad Wijaya',
                'phone' => '081111111111',
            ],
            [
                'name' => 'Maya Putri',
                'phone' => '081222222222',
            ],
            [
                'name' => 'Rudi Pratama',
                'phone' => '081333333333',
            ],
        ];
        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Ambil semua data yang dibutuhkan
        $customersList = Customer::all();
        $laundriesList = Laundry::all();
        $servicesList = Service::all();

        // Buat 15 order dummy
        $statuses = ['pending', 'washed', 'dried', 'ironed', 'ready_picked', 'completed', 'cancelled'];
        for ($i = 0; $i < 15; $i++) {
            Order::create([
                'customer_id' => $customersList[$i % $customersList->count()]->id,
                'laundry_id' => $laundriesList[0]->id,
                'service_id' => $servicesList[$i % $servicesList->count()]->id,
                'weight' => rand(1, 5),
                'total_price' => rand(7000, 25000),
                'note' => 'Order dummy ke-' . ($i + 1),
                'status' => $statuses[array_rand($statuses)],
                'order_date' => now(),
                'barcode' => (string) Str::uuid(),
            ]);
        }
    }
}
