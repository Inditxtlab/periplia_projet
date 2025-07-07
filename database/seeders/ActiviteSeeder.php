<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActiviteSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les voyages existants par leur nom
        $voyageProvence = DB::table('voyages')->where('nom_voyage', 'Découverte de la Provence')->first();
        $voyagePerou = DB::table('voyages')->where('nom_voyage', 'Aventure au Pérou')->first();

        if (!$voyageProvence || !$voyagePerou) {
            $this->command->warn('Voyages non trouvés : seed des activités annulé.');
            return;
        }

        // Activités pour le voyage en Provence
        DB::table('activites')->insert([
            [
                'titre' => 'Visite des villages perchés',
                'date' => Carbon::parse('2025-08-02'),
                'lieu' => 'Gordes, France',
                'description' => 'Découverte de Gordes, un des plus beaux villages de Provence.',
                'heure_debut' => '09:00:00',
                'heure_fin' => '12:00:00',
                'id_voyage' => $voyageProvence->id_voyage,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Dégustation de vins',
                'date' => Carbon::parse('2025-08-03'),
                'lieu' => 'Châteauneuf-du-Pape, France',
                'description' => 'Visite des caves et dégustation de grands crus.',
                'heure_debut' => '14:00:00',
                'heure_fin' => '17:00:00',
                'id_voyage' => $voyageProvence->id_voyage,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Activités pour le voyage au Pérou
        DB::table('activites')->insert([
            [
                'titre' => 'Randonnée vers le Machu Picchu',
                'date' => Carbon::parse('2025-10-12'),
                'lieu' => 'Cusco, Pérou',
                'description' => 'Marche sur l’Inca Trail avec des guides locaux.',
                'heure_debut' => '06:00:00',
                'heure_fin' => '18:00:00',
                'id_voyage' => $voyagePerou->id_voyage,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Visite de la Vallée Sacrée',
                'date' => Carbon::parse('2025-10-14'),
                'lieu' => 'Urubamba, Pérou',
                'description' => 'Exploration des sites archéologiques et villages andins.',
                'heure_debut' => '09:00:00',
                'heure_fin' => '16:00:00',
                'id_voyage' => $voyagePerou->id_voyage,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

