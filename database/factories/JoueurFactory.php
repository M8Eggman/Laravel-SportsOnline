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
        $genres = Genre::pluck('id')->toArray();
        $equipes = Equipe::pluck('id')->toArray();

        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'age' => $this->faker->numberBetween(16, 35),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'pays' => $this->faker->country(),
            'position_id' => $this->faker->randomElement($positions),
            // possibilité de pas avoir d'équipe
            'equipe_id' => $this->faker->optional(0.7)->randomElement($equipes),
            'genre_id' => $this->faker->randomElement($genres),
            'user_id' => User::first()->id,
            'photo_id' => null,
        ];
    }
}
