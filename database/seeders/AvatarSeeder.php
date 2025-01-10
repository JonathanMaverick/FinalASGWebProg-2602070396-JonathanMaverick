<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Avatar::create([
                'name' => $faker->name,
                'price' => $faker->randomFloat(2, 50, 100000),
                'image_url' => 'Karafuru/' . $index . '.jpg',
            ]);
        }
    }
}
