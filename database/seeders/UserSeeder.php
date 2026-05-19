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
            ['email' => 'rokas.giedraitis@stud.svako.lt'],
            [
                'name' => 'Administratorius',
                'password' => Hash::make('rokas123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'support@stud.svako.lt'],
            [
                'name' => 'Support darbuotojas',
                'password' => Hash::make('rokas123'),
                'role' => 'support',
            ]
        );

        User::firstOrCreate(
            ['email' => 'Edvinas@stud.svako.lt'],
            [
                'name' => 'Paprastas vartotojas',
                'password' => Hash::make('rokas123'),
                'role' => 'user',
            ]
        );
    }
}
