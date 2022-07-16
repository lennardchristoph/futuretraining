<?php

namespace App\Http\Livewire;

use App\Models\Ingredient;
use Livewire\Component;
use App\Models\Meal;
use \Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class MealList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'meals.id';
    public $sortAsc = true;
    public $perPage = 25;
    //Macros


    public function mount() {

    }

    public function calculateKcal(int $mealId)
    {
        $kcal = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach($ings as $ing) {
            $kcal += ($ing->amount/100) * $ing->kcal;
        }
        return $kcal;
    }

    public function calculateCarbs(int $mealId)
    {
        $carbs = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach($ings as $ing) {
            $carbs += ($ing->amount/100) * $ing->carbs;
        }
        return $carbs;
    }
    public function calculateProtein(int $mealId)
    {
        $protein = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach($ings as $ing) {
            $protein += ($ing->amount/100) * $ing->protein;
        }
        return $protein;
    }
    public function calculateFat(int $mealId)
    {
        $fat = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach($ings as $ing) {
            $fat += ($ing->amount/100) * $ing->fat;
        }
        return $fat;
    }

    public function render()
    {
        return view('livewire.meal-list', [
            'meals' => Meal::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage)
        ]);
    }
}
