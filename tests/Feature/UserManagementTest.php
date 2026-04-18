<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_user_index(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this->actingAs($admin)->get('/users');

        $response->assertOk();
        $response->assertSee('Usuarios');
    }

    public function test_admin_can_create_user(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this->actingAs($admin)->post('/users', [
            'name' => 'New Client',
            'email' => 'client@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => User::ROLE_CLIENT,
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'email' => 'client@example.com',
            'role' => User::ROLE_CLIENT,
        ]);
    }

    public function test_admin_can_update_user(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $user = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $response = $this->actingAs($admin)->put("/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => '',
            'role' => User::ROLE_ADMIN,
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'role' => User::ROLE_ADMIN,
        ]);
    }

    public function test_admin_can_delete_user(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $user = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $response = $this->actingAs($admin)->delete("/users/{$user->id}");

        $response->assertRedirect('/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_client_cannot_access_admin_routes(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($client);

        $this->get('/users')->assertForbidden();
        $this->get('/dashboard')->assertForbidden();
    }

    public function test_client_can_access_profile_and_home(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($client)->get('/profile')->assertOk();
        $this->get('/')->assertOk();
    }
}
