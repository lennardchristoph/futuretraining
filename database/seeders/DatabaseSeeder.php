<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([UnitSeeder::class]);
        $this->call([AthleteSeeder::class]);
        $this->call([IngredientSeeder::class]);
        //$this->call([MealSeeder::class]);
    }
}
