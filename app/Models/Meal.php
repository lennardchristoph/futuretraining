<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image'
    ];

    public static function mealMacros($mealID) {
        return DB::table('meal_ingredients')->where('meal_ingredients.meal_id', $mealID)
            ->join('ingredients', 'ingredients.id', '=', 'meal_ingredients.ingredient_id')
            ->select('ingredients.id', 'meal_ingredients.meal_id', 'meal_ingredients.amount', 'meal_ingredients.unit', 'ingredients.de_name', 'ingredients.en_name', 'ingredients.fr_name', 'ingredients.es_name' , 'ingredients.kcal', 'ingredients.carbs', 'ingredients.protein', 'ingredients.fat')
            ->get()->toArray();

    }

    public static function search($search) {
        return empty($search)
            ?
                static::query()
            :
                static::where('de_title', 'like', '%'.$search.'%');
    }

    public static function planIngredients($mealID)
    {
        return DB::table('plan_meal_ingredients')->where('plan_meal_ingredients.plan_meal_id', $mealID)
            ->join('ingredients', 'ingredients.id', '=', 'plan_meal_ingredients.ingredient_id')
            ->select('ingredients.id', 'plan_meal_ingredients.plan_meal_id', 'plan_meal_ingredients.final_amount', 'plan_meal_ingredients.unit', 'ingredients.de_name', 'ingredients.en_name', 'ingredients.fr_name', 'ingredients.es_name' , 'ingredients.kcal', 'ingredients.carbs', 'ingredients.protein', 'ingredients.fat')
            ->get()->toArray();
    }


    public function plan(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Plan', 'plan_meals');
    }

    public function ingredients(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Ingredient', 'meal_ingredients', 'meal_id', 'ingredient_id')
            ->withPivot('amount', 'unit');
    }
}
