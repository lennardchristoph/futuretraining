<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['name' => 'gramm', 'short' => 'g'],
            ['name' => 'milliliter', 'short' => 'ml']
        ];

        foreach($units as $value) {
            DB::table('units')->insert([
                'unit' => $value['name'],
                'short' => $value['short']
            ]);
        }
    }
}
