<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname', 'lastname', 'age', 'height', 'weight', 'sportexperience', 'frequency', 'sleeptime', 'incompatibility', 'actualkcal', 'level', 'aim'
    ];

    public static function search($search) {
        return empty($search) ? static::query()
            : static::query()->where('surname', 'like', '%'.$search.'%')
                ->orWhere('lastname', 'like', '%'.$search.'%')
                ->orWhere('age', 'like', '%'.$search.'%')
                ->orWhere('height', 'like', '%'.$search.'%')
                ->orWhere('weight', 'like', '%'.$search.'%');
    }

    public function plans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Plan', 'athlete_id', 'id');
    }
}
