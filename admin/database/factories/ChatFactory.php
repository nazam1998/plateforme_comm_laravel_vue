<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $entreprise = Entreprise::inRandomOrder()->first();

        $admin = User::first();

        // Choisis un chiffre au hasard  pour choisir soit l'admin soit l'entreprise

        $rand = rand(0, 200);

        if ($rand > 100) {
            $currentUser = $admin->id;
        } else {
            $currentUser = $entreprise->user_id;
        }

        return [
            'entreprise_id' => $entreprise->tva,
            'author_id' => $currentUser,
            'msg' => $this->faker->realText(),

        ];
    }
}
