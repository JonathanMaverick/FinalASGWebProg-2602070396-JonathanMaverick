<?php

namespace Database\Seeders;

use App\Models\Hobby;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // User::factory(10)->create();
        $user = User::create([
            'name' => 'jmaverick_',
            'email' => 'veka@gmail.com',
            'password' => Hash::make('veka123'),
            'gender' => 'Male',
            'instagram' => $faker->userName,
            'mobile_number' => $faker->phoneNumber,
            'balance' => 99001210,
        ]);

        $this->call(HobbySeeder::class);
        $hobbies = Hobby::all();
        $user->hobbies()->attach($hobbies->pluck('id')->random(3));

        $this->call(AvatarSeeder::class);
    }
}
