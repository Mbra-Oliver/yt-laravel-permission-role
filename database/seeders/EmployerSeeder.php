<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $faker = Faker::create();

        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'phone_number' => $faker->phoneNumber(),
                'hire_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('employes')->insert($data);
    }
}
