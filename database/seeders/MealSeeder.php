<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meals')->insert([
            'title' => 'Nudeln mit Tomatensauce',
            'description' => 'Ich koche dich so und so',
            'image' => 'xxx',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        $meal_ings = [
            ['meal_id' => 1, 'ingredient_id' => 1, 'amount' => 200, 'unit' => 1],
            ['meal_id' => 1, 'ingredient_id' => 1, 'amount' => 150, 'unit' => 2]
        ];

        foreach($meal_ings as $value) {
            DB::table('meal_ingredients')->insert([
                'meal_id' => $value['meal_id'],
                'ingredient_id' => $value['ingredient_id'],
                'amount' => $value['amount'],
                'unit' => $value['unit']
            ]);
        }
    }
}
