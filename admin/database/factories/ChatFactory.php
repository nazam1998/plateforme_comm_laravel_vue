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

        $rand = rand(0, 200);
        if($rand>100){
            $currentUser = $admin;
        }else{
            $currentUser = $entreprise->user;
        }

        return [
            'entreprise_id' => $entreprise->tva,
            'author_id'=>$currentUser->id,
            'msg'=>$this->faker->realText(),

        ];
    }
}
