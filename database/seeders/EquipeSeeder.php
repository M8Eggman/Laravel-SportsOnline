<?php

namespace Database\Seeders;

use App\Models\Continent;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masculin = Genre::where('name', 'masculin')->first()->id;
        $feminin = Genre::where('name', 'feminin')->first()->id;
        $mixte = null;

        $equipes = [
            [
                'name' => 'Fnatic',
                'city' => 'Londres',
                'src' => 'seeder_equipe_photos/fnatic.jpg',
                'genre_id' => $masculin,
                'continent_id' => Continent::where('name', 'Europe')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Gambit Esports',
                'city' => 'Moscou',
                'src' => 'seeder_equipe_photos/gambit_esports.jpg',
                'genre_id' => $masculin,
                'continent_id' => Continent::where('name', 'CIS')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Sentinels',
                'city' => 'Los Angeles',
                'src' => 'seeder_equipe_photos/sentinels.png',
                'genre_id' => $feminin,
                'continent_id' => Continent::where('name', 'Americas')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'ORDER',
                'city' => 'Sydney',
                'src' => 'seeder_equipe_photos/order.png',
                'genre_id' => $feminin,
                'continent_id' => Continent::where('name', 'Oceania')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Vision Strikers',
                'city' => 'Séoul',
                'src' => 'seeder_equipe_photos/vision_strikers.png',
                'genre_id' => $mixte,
                'continent_id' => Continent::where('name', 'Asia')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Anubis Gaming',
                'city' => 'Le Caire',
                'src' => 'seeder_equipe_photos/anubis_gaming.png',
                'genre_id' => $mixte,
                'continent_id' => Continent::where('name', 'Africa & Middle East')->first()->id,
                'user_id' => User::first()->id
            ]
        ];

        foreach ($equipes as $e) {
            Equipe::create($e);
        }
    }
}
