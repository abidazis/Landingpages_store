<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin APC',
            'email' => 'admin@apc.com', // Ganti dengan email Anda
            'email_verified_at' => now(),
            'password' => Hash::make('apcsuksesjaya'), // Ganti 'password' dengan password yang aman
        ]);
    }
}