<?php

namespace Database\Seeders;

use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Joueur;
use App\Models\Photo;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class JoueurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = Position::pluck('id')->toArray();
        $equipes = Equipe::all();

        // fonction pour récupérer une photo aléatoire depuis un dossier
        function getRandomPhoto($path)
        {
            $files = Storage::disk('public')->allFiles($path);
            return count($files) ? $files[array_rand($files)] : null;
        }

        function create_joueur($equipe, $positions, $base_genre)
        {
            // si équipe mixte, choisir un genre aléatoire pour le joueur
            $genre = $base_genre ?? Genre::all()->random();

            // déterminer le chemin des photos selon le genre
            $path = ($genre->name === 'male')
                ? 'seeder_player_photos/masculin'
                : 'seeder_player_photos/feminin';

            $first_name = ($genre->name === 'male') ? fake()->firstNameMale() : fake()->firstNameFemale();

            $joueur = Joueur::factory()->create([
                'first_name' => $first_name,
                'equipe_id' => $equipe->id,
                'genre_id' => $genre->id,
                'position_id' => $positions,
            ]);

            Photo::factory()->create([
                'src' => getRandomPhoto($path),
                'joueur_id' => $joueur->id,
            ]);
        }

        // création des joueurs pour chaque équipe
        foreach ($equipes as $equipe) {
            // 2 joueurs première position
            for ($i = 0; $i < 2; $i++) {
                create_joueur($equipe, $positions[0], $equipe->genre);
            }

            // 1 joueur pour chaque position restante
            foreach (array_slice($positions, 1) as $p) {
                create_joueur($equipe, $p, $equipe->genre);
            }

            // 2 remplaçants avec position aléatoires
            for ($i = 0; $i < 2; $i++) {
                create_joueur($equipe, $positions[array_rand($positions)], $equipe->genre);
            }
        }

        // création de 20 joueurs sans équipe et sans genre définis en particulier 
        for ($i = 0; $i < 20; $i++) {
            create_joueur((object) ['id' => null], $positions[array_rand($positions)], null);
        }
    }
}
