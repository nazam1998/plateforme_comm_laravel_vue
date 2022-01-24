<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            StatutSeeder::class,
            EntrepriseSeeder::class
        ]);
        \App\Models\Tache::factory(10)->create();
        \App\Models\Chat::factory(10)->create();
    }
}
