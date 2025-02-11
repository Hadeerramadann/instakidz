<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

       
        User::create([
            'name' => 'Admin',
            'email' => 'admin@instakidz.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
        ]);

       
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->userName . '@instakidz.com',
                'role' => 'teacher',
                'password' => Hash::make('123456'),
            ]);
        }


    }
}
