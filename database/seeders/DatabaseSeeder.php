<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(2)->create();

        // Création des classes de la 6ème à la Terminale
        $classes = ['6ème', '5ème', '4ème', '3ème', '2nde', '1ère', 'Tle'];

        foreach ($classes as $classe) {
            DB::table('classes')->insert([
                'classe' => $classe,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $series = [' ', 'A', 'B', 'C', 'D'];

        foreach ($series as $serie) {
            DB::table('series')->insert([
                'serie' => $serie,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        $groupes = [1, 2];

        foreach ($groupes as $groupe) {
            DB::table('groupes')->insert([
                'groupe' => $groupe,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $numeros = [1, 2];

        foreach ($numeros as $numero) {
            DB::table('numeros')->insert([
                'numero' => $numero,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        $matieres = ['Mathématiques', 'Français', 'Anglais', 'Hist-Géo', 'SVT', 'EPS', 'PCT'];

        // Boucle pour créer et enregistrer les matières
        foreach ($matieres as $matiere) {
            $nouvelleMatiere = new Matiere();
            $nouvelleMatiere->name = $matiere;
            $nouvelleMatiere->created_at = now();
            $nouvelleMatiere->updated_at = now();
            $nouvelleMatiere->save();
        }

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];

        foreach ($jours as $jour) {
            DB::table('jours')->insert([
                'jour' => $jour,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        $compositions = ['Interrogation', 'Devoir', 'Examen-Blanc'];

        foreach ($compositions as $composition) {
            DB::table('compositions')->insert([
                'type' => $composition,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $horaires = ['7h-8h', '8h-10h', '10h-12h', '13h-14h', '14h-15h', '15h-16h', '16h-17h', '17h-18h', '18h-19h'];

        foreach ($horaires as $horaire) {
            DB::table('horaires')->insert([
                'horaire' => $horaire,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        \App\Models\User::factory(1)->create();
    }
}
