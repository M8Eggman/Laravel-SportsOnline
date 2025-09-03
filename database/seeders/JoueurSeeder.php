<?php

namespace Database\Seeders;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Photo;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // crée une photo selon le path et retourne l'id correspondant
        function getRandomPhotoId($id, $path)
        {
            $files = Storage::disk('public')->allFiles($path);
            $file = count($files) ? $files[array_rand($files)] : null;
            
            return Photo::factory()->create([
                'joueur_id' => $id,
                'src' => $file,
            ])->id;
        }

        foreach ($equipes as $e) {
            // selon le genre de l'équipe choisis le bon dossier
            $path = match ($e->genre?->name) {
                'masculin' => 'seeder_player_photos/masculin',
                'feminin' => 'seeder_player_photos/feminin',
                default => 'seeder_player_photos',
            };

            // 2 joueurs pour la première position
            for ($i = 0; $i < 2; $i++) {
                $joueur = Joueur::factory()->create([
                    'equipe_id' => $e->id,
                    'position_id' => $positions[0],
                ]);
                getRandomPhotoId($joueur->id, $path);
            }

            // 1 joueur pour chaque position restante
            foreach (array_slice($positions, 1) as $p) {
                $joueur = Joueur::factory()->create([
                    'equipe_id' => $e->id,
                    'position_id' => $p,
                ]);
                getRandomPhotoId($joueur->id, $path);
            }

            // 2 remplaçants aléatoires
            for ($i = 0; $i < 2; $i++) {
                $joueur = Joueur::factory()->create([
                    'equipe_id' => $e->id,
                    'position_id' => $positions[array_rand($positions)],
                ]);
                getRandomPhotoId($joueur->id, $path);
            }
        }

        // crée 20 joueur sans equipes et le lie a une photo
        for ($i = 0; $i < 20; $i++) {
            $joueur = Joueur::factory()->create();
            getRandomPhotoId($joueur->id, $path);
        }
    }
}
