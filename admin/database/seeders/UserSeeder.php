<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'nazamfr1998@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('nazam@nazam.com'), // password
                'remember_token' => Str::random(10),
            ],
            [
                'email' => 'test@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('test@test.com'), // password
                'remember_token' => Str::random(10),
            ],
        ]);
    }
}
