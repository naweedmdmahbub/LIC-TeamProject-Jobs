<?php

namespace Database\Seeders;

use App\Constants\Role;
use App\Constants\Status;
use App\Models\User;
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
            'status' => Status::APPROVED,
            'password' => bcrypt('123456'),
        ]);

        // Company
        User::factory()->create([
            'name' => 'company',
            'email' => 'company@gmail.com',
            'role' => Role::COMPANY,
            'status' => Status::APPROVED,
            'password' => bcrypt('123456'),
        ]);

        // Candidates
        User::factory()->create([
            'name' => 'candidates',
            'email' => 'candidates@gmail.com',
            'status' => Status::APPROVED,
            'password' => bcrypt('123456'),
        ]);
    }
}
