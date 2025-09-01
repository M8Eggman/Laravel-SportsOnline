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
        function getRandomPhotoId($path)
        {
            $files = Storage::files($path);

            return Photo::factory()->create([
                'src' => Storage::url($files[array_rand($files)]),
            ])->id;
        }

        foreach ($equipes as $e) {
            // selon le genre de l'équipe choisis le bon dossier
            $path = match ($e->genre) {
                'masculin' => 'public/seeder_player_photos/masculin',
                'feminin' => 'public/seeder_player_photos/feminin',
                default => 'public/seeder_player_photos',
            };

            $files = Storage::files($path);

            // 2 joueurs pour la première position
            Joueur::factory(2)->has(Photo::factory())->create([
                '$equipe_id' => $e->id,
                'position_id' => $positions[0],
                'photo_id' => getRandomPhotoId($path),
            ]);

            // 1 joueur pour chaque position restante
            foreach (array_slice($positions, 1) as $p) {
                Joueur::factory()->has(Photo::factory())->create([
                    'equipe_id' => $e->id,
                    'position_id' => $p,
                    'photo_id' => getRandomPhotoId($path),
                ]);
            }

            // 2 remplaçants aléatoires
            for ($i = 0; $i < 2; $i++) {
                Joueur::factory()->has(Photo::factory())->create([
                    'equipe_id' => $e->id,
                    'position_id' => $positions[array_rand($positions)],
                    'photo_id' => getRandomPhotoId($path),
                ]);
            }
        }
    }
}
