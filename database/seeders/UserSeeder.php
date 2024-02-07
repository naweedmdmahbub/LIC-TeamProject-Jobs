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
        // Supper Admin
        User::factory()->create([
            'name' => 'Supper Admin',
            'email' => 'admin@gmail.com',
            'role' => Role::ADMIN
        ]);

        // Company
        User::factory()->create([
            'name' => 'company',
            'email' => 'company@gmail.com',
            'role' => Role::COMPANY
        ]);

        // Candidates
        User::factory()->create([
            'name' => 'candidates',
            'email' => 'candidates@gmail.com',
            'role' => Role::CANDIDATES
        ]);
    }
}
