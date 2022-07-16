<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('athletes')->insert([
            'surname' => 'Lennard',
            'lastname' => 'Meyer',
            'age' => '20',
            'height' => '176',
            'weight' => '74',
            'sportexperience' => 8,
            'frequency' => 6,
            'sleeptime' => 8,
            'incompatibility' => 0,
            'actualkcal' => 8,
            'level' => 8,
            'aim' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
