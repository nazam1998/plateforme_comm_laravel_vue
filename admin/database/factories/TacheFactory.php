<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\Statut;
use Illuminate\Database\Eloquent\Factories\Factory;

class TacheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entreprise_id' => Entreprise::inRandomOrder()->first()->tva,
            'statut_id' => Statut::inRandomOrder()->first()->id,
            'tache' => $this->faker->realText(),
        ];
    }
}
