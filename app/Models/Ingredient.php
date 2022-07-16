<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'de_name', 'en_name', 'fr_name', 'es_name', 'kcal', 'carbs', 'protein', 'fat', 'amount', 'unity'
    ];

    public static function search($search) {
        return empty($search) ? static::query()
            : static::where('name', 'like', '%'.$search.'%');
    }

    public static function calcKcal($mealId)
    {
        return DB::table('meal_ingredients')->where('meal_ingredients.meal_id', $mealId)
            ->join('ingredients', 'ingredients.id', '=', 'meal_ingredients.ingredient_id')
            ->select('meal_ingredients.meal_id', 'meal_ingredients.amount', 'ingredients.de_name', 'ingredients.en_name', 'ingredients.fr_name', 'ingredients.es_name', 'ingredients.kcal', 'ingredients.carbs', 'ingredients.protein', 'ingredients.fat')
            ->get();
    }

    public static function getIngredients($mealId)
    {
        return DB::table('meal_ingredients')->where('meal_ingredients.meal_id', $mealId)
            ->join('ingredients', 'ingredients.id', '=', 'meal_ingredients.ingredient_id')
            ->join('units', 'units.id', '=', 'meal_ingredients.unit')
            ->select('ingredients.id', 'meal_ingredients.meal_id', 'meal_ingredients.amount', 'meal_ingredients.unit', 'ingredients.de_name', 'ingredients.en_name', 'ingredients.fr_name', 'ingredients.es_name')
            ->get();
    }

    public function meal(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Meal', 'meal_ingredients');
    }
}
