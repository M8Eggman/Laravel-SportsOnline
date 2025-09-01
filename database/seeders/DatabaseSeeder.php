<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Continent;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Joueur;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Role::class);
        $this->call(User::class);
        $this->call(Continent::class);
        $this->call(Genre::class);
        $this->call(Position::class);
        $this->call(Equipe::class);
        $this->call(Joueur::class);
    }
}
