<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminUserSeeder::class);

        $user = \App\Models\User::where('email', 'admin@test.com')->first();

        if ($user) {
            $user->assignRole('Jefatura');
        }

        \App\Models\Airport::factory()->count(10)->create();
    }
}
