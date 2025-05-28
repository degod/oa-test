<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_user_and_total_user_count()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $mockRepo = Mockery::mock(UserRepositoryInterface::class);
        $mockRepo->shouldReceive('countAllUsers')->once()->andReturn(50);
        $this->app->instance(UserRepositoryInterface::class, $mockRepo);

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee('50');
    }
}
