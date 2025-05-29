<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        if (empty($userIds)) {
            User::factory()->count(5)->create();
            $userIds = User::pluck('id')->toArray();
            $this->command->info('No users found. Seeded 5 new users...');
        }

        Project::factory()
            ->count(10)
            ->make()
            ->each(function (Project $project) use ($userIds) {
                $project->user_id = collect($userIds)->random();
                $project->save();
            });

        $this->command->info('Seeded 10 projects.');
    }
}
