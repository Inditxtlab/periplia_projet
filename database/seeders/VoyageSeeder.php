<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VoyageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('voyages')->insert([
            [
                'id_voyage' => Str::uuid(),
                'id_user' => 2, // à adapter : l'id_user doit exister dans users
                'id_categorie' => 1, // idem : doit exister dans categories
                'nom_voyage' => 'Découverte de la Provence',
                'destination' => 'Provence, France',
                'description' => 'Circuit court pour explorer les villages et paysages provençaux.',
                'date_debut' => '2025-08-01',
                'date_fin' => '2025-08-07',
                'nombre_voyageurs' => 4,
                'status' => 'a_venir',
                'visibilite' => true,
                'image_couverture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_voyage' => Str::uuid(),
                'id_user' => 1, // même remarque : adapte selon tes users seedés
                'id_categorie' => 4, // par exemple 'Aventure'
                'nom_voyage' => 'Aventure au Pérou',
                'destination' => 'Cusco, Pérou',
                'description' => 'Un voyage épique vers le Machu Picchu.',
                'date_debut' => '2025-10-10',
                'date_fin' => '2025-10-25',
                'nombre_voyageurs' => 6,
                'status' => 'a_venir',
                'visibilite' => true,
                'image_couverture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
