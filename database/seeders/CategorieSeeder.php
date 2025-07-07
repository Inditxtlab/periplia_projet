<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'titre' => 'Circuits courts',
                'description' => 'Destinations proches pour des escapades de quelques jours.',
                'slug' => Str::slug('Circuits courts'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Petits budgets',
                'description' => 'Voyages accessibles pour les voyageurs économes.',
                'slug' => Str::slug('Petits budgets'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Week-end',
                'description' => 'courts séjours pour s’évader en 2-3 jours.',
                'slug' => Str::slug('weekend'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Aventure',
                'description' => 'Expéditions hors des sentiers battus et activités extrêmes.',
                'slug' => Str::slug('Aventure'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Famille',
                'description' => 'Voyages adaptés aux parents avec enfants.',
                'slug' => Str::slug('Famille'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Nature & Randonnée',
                'description' => ' itinéraires en pleine nature, parcs nationaux, balades.',
                'slug' => Str::slug('Nature et randonnee'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
