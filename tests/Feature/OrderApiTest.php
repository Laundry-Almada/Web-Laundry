<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_get_orders()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin, 'sanctum');

        Order::factory()->count(5)->create();

        $response = $this->getJson('/api/admin/orders');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'customer_id', 'laundry_id', 'service_id', 'status', 'order_date',
                ]
            ]
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_create_order()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin, 'sanctum');

        $customer = \App\Models\Customer::factory()->create();
        $laundry = \App\Models\Laundry::factory()->create();
        $service = \App\Models\Service::factory()->create(['laundry_id' => $laundry->id]);
        
        // Update admin dengan laundry_id yang sesuai
        $admin->update(['laundry_id' => $laundry->id]);
        
        $orderData = [
            'name' => $customer->name,
            'phone' => $customer->phone,
            'laundry_id' => $laundry->id,
            'service_id' => $service->id,
            'weight' => 2.5,
            'total_price' => 25000,
            'status' => 'pending',
            'order_date' => now()->format('Y-m-d H:i:s'),
        ];

        $response = $this->postJson('/api/admin/orders', $orderData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', [
            'laundry_id' => $laundry->id,
            'service_id' => $service->id,
            'weight' => 2.5,
            'total_price' => 25000,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_get_order_statistics()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $laundry = \App\Models\Laundry::factory()->create();
        $admin->update(['laundry_id' => $laundry->id]);
        $this->actingAs($admin, 'sanctum');

        $response = $this->getJson('/api/admin/orders/statistics?period=daily');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'date', 'count', 'revenue'
                ]
            ],
            'message'
        ]);
    }
}
