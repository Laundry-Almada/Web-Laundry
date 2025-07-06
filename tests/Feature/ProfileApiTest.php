<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class ProfileApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_get_user_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/user');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'email', 'phone', 'role', 'laundry_id'
            ]
        ]);
    }

    #[Test]
    public function it_can_update_user_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '987654321'
        ];

        $response = $this->putJson('/api/updateProfile', $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $updateData);
    }
}
