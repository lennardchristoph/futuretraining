<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'aim', 'comment', 'athlete_id', 'start_date', 'end_date'
    ];


    public function meals(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Meal', 'plan_meals', 'plan_id', 'meal_id');
    }

    public function athlete(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Athlete', 'athlete_id', 'id');
    }

    public static function search($search) {
        return empty($search) ? static::query()
            : static::where('name', 'like', '%'.$search.'%');
    }

}
