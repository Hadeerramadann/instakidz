<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\User;
use Faker\Factory as Faker;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        
        $teachers = User::where('role', 'teacher')->pluck('id')->toArray();

        
        for ($i = 0; $i < 10; $i++) {
            Classes::create([
                'name' => 'Class ' . ($i + 1),
                'teacher_id' => $faker->randomElement($teachers),
            ]);
        }
    }
}
