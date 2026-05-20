<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL')],
            [
                'name' => 'Administratorius',
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => env('SUPPORT_EMAIL')],
            [
                'name' => 'Support darbuotojas',
                'password' => Hash::make(env('SUPPORT_PASSWORD')),
                'role' => 'support',
            ]
        );

        User::firstOrCreate(
            ['email' => env('USER_EMAIL')],
            [
                'name' => 'Paprastas vartotojas',
                'password' => Hash::make(env('USER_PASSWORD')),
                'role' => 'user',
            ]
        );
    }
}
