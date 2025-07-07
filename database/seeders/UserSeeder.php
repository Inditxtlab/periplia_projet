<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'prenom' => 'Indira',
                'nom' => 'Ramirez',
                'email' => 'indira@example.com',
                'description_profil' => 'Client régulier.',
                'date_naissance' => '1985-12-10',
                'role' => 'client',
                'photo_profil' => null,
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'prenom' => 'Marie',
                'nom' => 'Martin',
                'email' => 'admin@example.com',
                'description_profil' => 'Administratrice du site.',
                'date_naissance' => '1985-07-22',
                'role' => 'admin',
                'photo_profil' => null,
                'email_verified_at' => now(),
                'password' => Hash::make('password456'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
