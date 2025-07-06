<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\Order;

class CustomerApiTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_check_customer_existence()
    {
        $customer = Customer::factory()->create(['phone' => '123456789']);

        $response = $this->getJson('/api/customers/check/123456789');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'email', 'phone', 'address'
            ]
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_customer_orders()
    {
        $customer = Customer::factory()->create(['phone' => '123456789']);
        Order::factory()->count(3)->create(['customer_id' => $customer->id]);

        $response = $this->getJson('/api/customers/123456789/orders');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'customer', 'laundry', 'service', 'status', 'order_date'
                ]
            ]
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_search_customers()
    {
        Customer::factory()->create(['name' => 'John Doe']);

        $response = $this->getJson('/api/customers/search?query=John');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'name', 'email', 'phone', 'address'
                ]
            ]
        ]);
    }
}
