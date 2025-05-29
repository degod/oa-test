<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_paginated_users_list()
    {
        User::factory()->count(15)->create();

        $response = $this->actingAs($this->admin)->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewHas('users');
    }

    public function test_admin_can_filter_users_by_name_email_and_role()
    {
        User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'user']);
        User::factory()->create(['name' => 'Admin Guy', 'email' => 'admin@example.com', 'role' => 'admin']);

        $response = $this->actingAs($this->admin)->get(route('users.index', [
            'name' => 'john',
            'email' => 'example.com',
            'role' => 'user',
        ]));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertDontSee('Admin Guy');
    }

    public function test_admin_can_update_a_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)->put(route('users.update', $user->id), [
            'name' => 'Updated Name',
            'role' => 'admin',
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'role' => 'admin',
            'is_active' => '1',
        ]);
    }

    public function test_admin_can_deactivate_and_reactivate_users()
    {
        $user = User::factory()->create(['is_active' => true]);

        // Deactivate
        $this->actingAs($this->admin)->post(route('users.toggle', $user->id));
        $this->assertEquals($user->fresh()->is_active, 0);

        // Reactivate
        $this->actingAs($this->admin)->post(route('users.toggle', $user->id));
        $this->assertEquals($user->fresh()->is_active, 1);
    }

    public function test_non_admin_cannot_access_user_management()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('users.index'));
        $response->assertForbidden();
    }
}
