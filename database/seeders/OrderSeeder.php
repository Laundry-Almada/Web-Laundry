<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Laundry;
use App\Models\Service;
use Carbon\Carbon;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $customers = Customer::all();
        $laundries = Laundry::all();
        $services = Service::all();
        $statuses = ['pending', 'washed', 'dried', 'ironed', 'ready_picked', 'completed', 'cancelled'];

        // Generate data untuk 2 bulan terakhir
        $startDate = Carbon::now()->subMonths(2)->startOfMonth();
        $endDate = Carbon::now();

        // Generate 50-100 order per hari
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $ordersPerDay = rand(50, 100);

            for ($i = 0; $i < $ordersPerDay; $i++) {
                $customer = $customers->random();
                $laundry = $laundries->random();
                $service = $services->random();
                $status = $faker->randomElement($statuses);

                // Generate waktu order antara jam 7 pagi sampai 9 malam
                $orderTime = $currentDate->copy()->setHour(rand(7, 21))->setMinute(rand(0, 59));

                // Jika status completed, set total_price
                $totalPrice = $status === 'completed' ? $faker->numberBetween(50000, 500000) : 0;

                Order::create([
                    'customer_id' => $customer->id,
                    'laundry_id' => $laundry->id,
                    'service_id' => $service->id,
                    'barcode' => 'ORD-' . strtoupper(uniqid()),
                    'order_date' => $orderTime,
                    'status' => $status,
                    'weight' => $faker->randomFloat(2, 1, 10),
                    'total_price' => $totalPrice,
                    'created_at' => $orderTime,
                    'updated_at' => $orderTime,
                ]);
            }

            $currentDate->addDay();
        }
    }
}
