<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = [
            'Reading',
            'Photography',
            'Cycling',
            'Cooking',
            'Gardening',
            'Painting',
            'Drawing',
            'Travelling',
            'Writing',
            'Swimming',
            'Playing Guitar',
            'Dancing',
            'Fishing',
            'Hiking',
            'Skiing',
            'Camping',
            'Jogging',
            'Knitting',
            'Video Gaming',
            'Rock Climbing',
        ];

        foreach ($hobbies as $hobby) {
            DB::table('hobbies')->insert(['name' => $hobby]);
        }
    }
}
