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
                'url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvKsT2I_cdKtKKhkMrdVtGCTnvJIORfGoEsw&s',
                'genre_id' => $masculin,
                'continent_id' => Continent::where('name', 'Europe')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Gambit Esports',
                'city' => 'Moscou',
                'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/Gambit_Esports_2020_logo.svg/1200px-Gambit_Esports_2020_logo.svg.png',
                'genre_id' => $masculin,
                'continent_id' => Continent::where('name', 'CIS')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Sentinels',
                'city' => 'Los Angeles',
                'url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzi5O4G48EVu4WG2ote3S9KJUlkkHKM96Rpg&s',
                'genre_id' => $feminin,
                'continent_id' => Continent::where('name', 'Americas')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'ORDER',
                'city' => 'Sydney',
                'url' => 'https://www.thespike.gg/_next/image?url=https%3A%2F%2Fcdn.thespike.gg%2FTeams%2525204%252Forder_1643360809620.png&w=640&q=75',
                'genre_id' => $feminin,
                'continent_id' => Continent::where('name', 'Oceania')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Vision Strikers',
                'city' => 'Séoul',
                'url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhbH1jkdsCNB1PL8qlWlP-ErAZA8R65NtXDg&s',
                'genre_id' => $mixte,
                'continent_id' => Continent::where('name', 'Asia')->first()->id,
                'user_id' => User::first()->id
            ],
            [
                'name' => 'Anubis Gaming',
                'city' => 'Le Caire',
                'url' => 'https://owcdn.net/img/61b99de181b2e.png',
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
