<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->get();

        if ($users->isEmpty()) {
            $this->command->warn('Aucun utilisateur trouvé : seed des documents annulé.');
            return;
        }

        DB::table('documents')->insert([
            [
                'id_user' => 1,
                'document' => 'Passeport_Indira_Ramirez.pdf',
                'type_doc' => 'passeport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'document' => 'Assurance_voyage_Indira.pdf',
                'type_doc' => 'assurance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'document' => 'Visa_perou.pdf',
                'type_doc' => 'visa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
