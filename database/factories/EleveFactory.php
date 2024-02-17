<?php

namespace Database\Factories;

use App\Models\Serie;
use App\Models\Classe;
use App\Models\Groupe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Eleve>
 */
class EleveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricule' => fake()->unique()->text(10),
            'name' => fake()->unique()->name(),
            'email' => fake()->unique()->email(),
            'telephone' => fake()->unique()->phoneNumber(),
            'genre' => fake()->randomElement(['M', 'F']),
            'date_naissance' => fake()->date(),
            'lieu_naissance' => fake()->city(),
            'avatar' => fake()->imageUrl(),
            'classe_id' => 1,
            'serie_id' => 1,
            'groupe_id' => 1,
        ];
    }
}
