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
        // $this->call([
        //     UserSeeder::class,
        //     CustomerSeeder::class,
        //     LaundrySeeder::class,
        //     ServiceSeeder::class,
        //     OrderSeeder::class,
        // ]);

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
                'name' => 'Customer Dummy ' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'phone' => '081' . str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT),
            ],
            [
                'name' => 'Customer Dummy ' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'phone' => '081' . str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT),
            ],
            [
                'name' => 'Customer Dummy ' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'phone' => '081' . str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT),
            ],
        ];
        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Ambil semua data yang dibutuhkan
        $customersList = Customer::all();
        $laundriesList = Laundry::all();
        $servicesList = Service::all();

        // Generate order 2 bulan terakhir
        $faker = \Faker\Factory::create('id_ID');
        $statuses = ['pending', 'washed', 'dried', 'ironed', 'ready_picked', 'completed', 'cancelled'];
        $startDate = now()->subMonths(2)->startOfMonth();
        $endDate = now();
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $ordersPerDay = rand(50, 100);
            for ($i = 0; $i < $ordersPerDay; $i++) {
                $customer = $customersList->random();
                $laundry = $laundriesList->random();
                $service = $servicesList->random();
                $status = $faker->randomElement($statuses);
                $orderTime = $currentDate->copy()->setHour(rand(7, 21))->setMinute(rand(0, 59));
                $totalPrice = $faker->numberBetween(50000, 500000);

                // Generate random notes
                $noteOptions = [
                    'Tolong cuci dengan lembut',
                    'Pakaian sensitif warna',
                    'Jangan gunakan pewangi terlalu banyak',
                    'Pakaian anak, cuci terpisah',
                    'Ada noda di bagian kerah, tolong dibersihkan',
                    'Setrika dengan suhu rendah',
                    'Pakaian formal, butuh perhatian khusus',
                    'Tolong selesaikan secepatnya',
                    'Ambil Jumat sore',
                    'Baju putih dicuci terpisah',
                    '',
                    '',
                    ''  // Empty notes are more likely
                ];

                Order::create([
                    'customer_id' => $customer->id,
                    'laundry_id' => $laundry->id,
                    'service_id' => $service->id,
                    'barcode' => 'ORD-' . strtoupper(uniqid()),
                    'order_date' => $orderTime,
                    'status' => $status,
                    'weight' => $faker->randomFloat(2, 1, 10),
                    'total_price' => $totalPrice,
                    'note' => $faker->randomElement($noteOptions),
                    'created_at' => $orderTime,
                    'updated_at' => $orderTime,
                ]);
            }
            $currentDate->addDay();
        }
    }
}
