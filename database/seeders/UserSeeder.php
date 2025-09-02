<?php

namespace Database\Seeders;

use App\Models\Role;
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
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);
        User::factory()->create([
            'first_name' => 'Coach',
            'last_name' => 'Coach',
            'email' => 'coach@example.com',
            'password' => 'password',
            'role_id' => Role::where('name', 'coach')->first()->id,
        ]);
        User::factory()->create([
            'first_name' => 'User',
            'last_name' => 'User',
            'email' => 'user@example.com',
            'password' => 'password',
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);
    }
}
