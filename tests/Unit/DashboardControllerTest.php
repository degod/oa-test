<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Project\ProjectRepositoryInterface;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_all_required_statistics()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $mockUserRepo = Mockery::mock(UserRepositoryInterface::class);
        $mockUserRepo->shouldReceive('countAllUsers')->once()->andReturn(50);
        $mockUserRepo->shouldReceive('countByRole')->with('admin')->once()->andReturn(10);
        $mockUserRepo->shouldReceive('countByRole')->with('user')->once()->andReturn(40);
        $this->app->instance(UserRepositoryInterface::class, $mockUserRepo);

        $mockProjectRepo = Mockery::mock(ProjectRepositoryInterface::class);
        $mockProjectRepo->shouldReceive('countAllProjects')->once()->andReturn(25);
        $this->app->instance(ProjectRepositoryInterface::class, $mockProjectRepo);

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee('50');
        $response->assertSee('10');
        $response->assertSee('40');
        $response->assertSee('25');
    }
}
