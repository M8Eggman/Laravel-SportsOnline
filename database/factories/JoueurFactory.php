<?php

namespace Database\Factories;

use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joueur>
 */
class JoueurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // récupère les informations dans les autres tables
        $positions = Position::pluck('id')->toArray();
        $equipes = Equipe::pluck('id')->toArray();
        // récupère un objet genre aléatoire et lutilise pour le nom et le genre de la personne
        $genre = Genre::all()->random();

        return [
            // selon le genre de la personne adapte son prenom
            'first_name' => match ($genre->name) {
                'masculin' => $this->faker->firstNameMale(),
                'feminin' => $this->faker->firstNameFemale(),
                default => $this->faker->firstName(),
            },
            'last_name' => $this->faker->lastName(),
            'age' => $this->faker->numberBetween(16, 35),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'city' => $this->faker->city(),
            // possibilité de pas avoir d'équipe
            'equipe_id' => null,
            'position_id' => $this->faker->randomElement($positions),
            'genre_id' => $genre->id,
            'user_id' => User::first()->id,
        ];
    }
}
