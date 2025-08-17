<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Zain',
            'email' => 'zain@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
