<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('laundry_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreign('laundry_id')->references('id')->on('laundries')->onDelete('cascade');
            $table->timestamps();
        });

        // Insert default global services (tanpa laundry_id)
        $defaultServices = [
            [
                'id' => (string) Str::uuid(),
                'name' => 'Kiloan',
                'description' => 'Layanan cuci per kilogram',
                'price' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Express',
                'description' => 'Layanan cuci cepat 3 jam',
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Satuan',
                'description' => 'Layanan cuci per pcs',
                'price' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Regular',
                'description' => 'Layanan cuci regular 24 jam',
                'price' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('services')->insert($defaultServices);

        // Insert default services for all laundries
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

        // Hanya insert jika tabel laundries dan services sudah ada (untuk migrasi fresh)
        if (Schema::hasTable('laundries')) {
            foreach (DB::table('laundries')->get() as $laundry) {
                foreach ($services as $service) {
                    DB::table('services')->insert([
                        'id' => (string) Str::uuid(),
                        'laundry_id' => $laundry->id,
                        'name' => $service['name'],
                        'description' => $service['description'],
                        'price' => $service['price'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
