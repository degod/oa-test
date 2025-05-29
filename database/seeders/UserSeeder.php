<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@mail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('superadmin'),
                'role' => 'admin',
            ]
        );
        $this->command->info('An "admin" created as "superadmin@mail.com"...');
        $this->command->info('SuperAdmin password is "superadmin"...');

        User::factory()->count(5)->create();
        $this->command->info('Seeded 5 "user" roles.');
    }
}
