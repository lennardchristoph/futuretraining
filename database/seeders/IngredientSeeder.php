<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ings = [
            ['de_name' => 'Nudeln', 'en_name' => 'Nudeln', 'fr_name' => 'Nudeln', 'es_name' => 'Nudeln', 'kcal' => 220, 'carbs' => 18, 'protein' => 12, 'fat' => 4, 'amount' => 100, 'unity' => 'g'],
            ['de_name' => 'Tomatensauce', 'en_name' => 'Tomatensauce', 'fr_name' => 'Tomatensauce', 'es_name' => 'Tomatensauce', 'kcal' => 350, 'carbs' => 5, 'protein' => 15, 'fat' => 12, 'amount' => 100, 'unity' => 'ml']
        ];

        foreach($ings as $value) {
            DB::table('ingredients')->insert([
                'de_name' => $value['de_name'],
                'en_name' => $value['en_name'],
                'fr_name' => $value['fr_name'],
                'es_name' => $value['es_name'],
                'kcal' => $value['kcal'],
                'carbs' => $value['carbs'],
                'protein' => $value['protein'],
                'fat' => $value['fat'],
                'amount' => $value['amount'],
                'unity' => $value['unity'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
