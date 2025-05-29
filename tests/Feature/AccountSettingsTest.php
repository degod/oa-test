<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('account.profile.update'), [
            'name' => 'Updated Name',
            'email' => 'updated@email.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Profile updated successfully');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_user_can_update_password()
    {
        $user = User::factory()->create(['password' => bcrypt('oldpassword123')]);

        $response = $this->actingAs($user)->put(route('account.password.update'), [
            'old_password' => 'oldpassword123',
            'new_password' => 'newsecurepassword',
            'new_password_confirmation' => 'newsecurepassword',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Password updated successfully');

        $this->assertTrue(password_verify('newsecurepassword', $user->fresh()->password));
    }

    public function test_password_update_fails_with_wrong_old_password()
    {
        $user = User::factory()->create(['password' => bcrypt('correctpass')]);

        $response = $this->actingAs($user)->put(route('account.password.update'), [
            'old_password' => 'wrongpassword',
            'new_password' => 'newpass123',
            'new_password_confirmation' => 'newpass123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['old_password']);
    }
}
