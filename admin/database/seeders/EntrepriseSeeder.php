<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $user = User::inRandomOrder()->where('id', '!=', 1)->first();
        DB::table('entreprises')->insert([
            'tva' => $faker->numerify('########'),
            'nom' => $faker->company,
            'activite' => $faker->bs,
            'adresse' => $faker->address,
            'ville' => $faker->city,
            'numero' => $faker->numerify('##########'),
            'code_postal' => $faker->numerify('#####'),
            'nom_contact' => $faker->name,
            'email_contact' => $faker->email,
            'numero_contact' => $faker->numerify('##########'),
            'user_id' => $user->id

        ]);
        DB::table('entreprises')->insert([
            'tva' => $faker->numerify('########'),
            'nom' => $faker->company,
            'activite' => $faker->bs,
            'adresse' => $faker->address,
            'ville' => $faker->city,
            'numero' => $faker->numerify('##########'),
            'code_postal' => $faker->numerify('#####'),
            'nom_contact' => $faker->name,
            'email_contact' => $faker->email,
            'numero_contact' => $faker->numerify('##########'),
            'user_id' => $user->id

        ]);
    }
}
