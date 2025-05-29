<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_project()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('projects.store'), [
                'title' => 'Test Project',
                'description' => 'Test Description',
                'task' => 'Test Task',
            ])
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', ['title' => 'Test Project']);
    }

    public function test_project_index_shows_projects()
    {
        $user = User::factory()->create();
        Project::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('projects.index'))
            ->assertStatus(200)
            ->assertSee('Projects');
    }

    public function test_authenticated_user_can_update_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->put(route('projects.update', $project->id), [
                'title' => 'Updated Project',
                'description' => 'Updated Desc',
                'task' => 'Updated Task',
            ])
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', ['title' => 'Updated Project']);
    }

    public function test_authenticated_user_can_delete_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete(route('projects.destroy', $project->id))
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
