<?php

namespace Database\Seeders;

use App\Constants\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'role' => Role::ADMIN,
            'password' => bcrypt('123456'),
        ]);

        // Company
        User::factory()->create([
            'name' => 'company',
            'email' => 'company@gmail.com',
            'role' => Role::COMPANY,
            'password' => bcrypt('123456'),
        ]);

        // Candidates
        User::factory()->create([
            'name' => 'candidates',
            'email' => 'candidates@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
