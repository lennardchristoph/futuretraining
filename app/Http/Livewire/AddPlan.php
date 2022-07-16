<?php

namespace App\Http\Livewire;

use App\Models\Athlete;
use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Plan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class AddPlan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /*********************************************
     * Pagination Variables
     *********************************************/

    public $search = '';
    public $sortField = 'meals.de_title';
    public $sortAsc = true;
    public $perPage = 5;

    /*********************************************
     * Variables
     *********************************************/
    //Plan Variables
    public $planName, $planComment, $start_date, $end_date, $aimKcal, $aimCarbs, $aimProteine, $aimFat, $aimSelection;
    //Logic Variables
    public $step, $day, $mealID, $dayTime, $modalTitle, $addedMealsKey, $athlete;
    //Calculation Variables
    public $finalKcal, $finalCarbs, $finalProtein, $finalFat;
    /*********************************************
     * Arrays
     *********************************************/

    public $dayArray = [];
    public $addedMeals = [];
    public $ingredients = [];
    public $editIngs = [];
    public $editedIngs = [];


    /*********************************************
     * Multistepform Logic
     *********************************************/

    public function mount()
    {
        $this->step = 0;
        $this->day = -1;
        $this->finalKcal = 0;
        $this->finalCarbs = 0;
        $this->finalProtein = 0;
        $this->finalFat = 0;
        $this->start_date = Carbon::now()->toDateString();
        $this->end_date = Carbon::now()->addMonths(3)->toDateString();

    }

    public function increaseStep()
    {
        if($this->step == 0) {
            //Prüft auf der ersten Seite ob alle nötigen Felder ausgefüllt sind
            Carbon::parse($this->start_date)->format('Y-m-d');
            Carbon::parse($this->end_date)->format('Y-m-d');
            $this->validate([
                'planName' => 'max:255',
                'aimSelection' => 'required',
                'athlete' => 'required|numeric',
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
                'aimKcal' => 'required|numeric|min:1|max:8000',
                'aimCarbs' => 'required|numeric|min:1|max:8000',
                'aimProteine' => 'required|numeric|min:1|max:8000',
                'aimFat' => 'required|numeric|min:1|max:8000']);
        } else if($this->step > 0 && $this->step <= 7) {
            //Prüft ob jeder Tag mindestens ein Gericht hat
            $this->validate([
                "dayArray"    => "required|array|min:$this->step"], [
                'dayArray.required' => 'Please add at least 1 meal',
                'dayArray.size' => 'Please add at least x meal',
                'dayArray.array' => 'Please fill out all amounts',
            ]);
        }
        $this->day++;
        $this->step++;

        $this->finalKcal = 0;
        $this->finalCarbs = 0;
        $this->finalProtein = 0;
        $this->finalFat = 0;

        if(!empty($this->dayArray[$this->day])) {
            $this->calculateMakrosNew();
        }
    }

    public function decreaseStep()
    {
        $this->step--;
        $this->day--;

        $this->finalKcal = 0;
        $this->finalCarbs = 0;
        $this->finalProtein = 0;
        $this->finalFat = 0;

        if($this->day > -1) {
            $this->calculateMakrosNew();
        }

    }

    /*********************************************
     * Modal Functions
     *********************************************/

    public function openMealModal($mealID)
    {
        $this->ingredients = [];
        $meal = Meal::where('id', $mealID)->firstOrFail();
        $this->ingredients = $meal->ingredients;
        $this->mealID = $meal->id;
        $this->modalTitle = $meal->de_title;
    }

    public function openEditModal($arrayKey)
    {
        $this->editIngs = [];
        $this->editedIngs = [];
        foreach ($this->dayArray[$this->day][$arrayKey][0] as $ing) {
            array_push($this->editIngs, $ing);
        }
        $this->addedMealsKey = $arrayKey;
    }

    /*********************************************
     * Meal Functions
     *********************************************/

    public function addMeal($mealID)
    {
        $this->validate([
            'dayTime' => 'required|max:2']);

        $meal = Meal::where('id', $mealID)->firstOrFail();
        $ings = Meal::mealMacros($mealID);
        $mealArray = ['id' => $meal->id, 'title' => $meal->de_title, 'dayTime' => $this->dayTime];
        array_push($mealArray, $ings);
        array_push($this->addedMeals, $mealArray);

        if (empty($this->dayArray)) {
            array_push($this->dayArray, $this->addedMeals);
        } else {
            $this->dayArray[$this->day][] = $mealArray;
        }

        $kcal = 0;
        $carbs = 0;
        $protein = 0;
        $fat = 0;
        foreach ($mealArray[0] as $key => $aMeal) {
            $ing = Ingredient::where('id', $mealArray[0][$key]->id)->firstOrFail();

            $kcal += ($aMeal->amount / 100) * $ing->kcal;
            $carbs += ($aMeal->amount / 100) * $ing->carbs;
            $protein += ($aMeal->amount / 100) * $ing->protein;
            $fat += ($aMeal->amount / 100) * $ing->fat;
        }
        $this->finalKcal += $kcal;
        $this->finalCarbs += $carbs;
        $this->finalProtein += $protein;
        $this->finalFat += $fat;
    }

    public function editMeal($arrayKey)
    {
        $this->validate([
            'editedIngs.*' => 'required|numeric'
        ], [
            'editedIngs.*.required' => 'Please fill out all amounts',
            'editedIngs.*.numeric' => 'Please only fill in numbers',
        ]);

        $this->editedIngs = array_reverse($this->editedIngs, true);
        $this->subtractMacros($arrayKey);
        foreach ($this->editedIngs as $key => $eIng) {
            $this->dayArray[$this->day][$arrayKey][0][$key]['amount'] = $eIng;
        }
        $this->recalculateMacrosEdited($arrayKey);
    }

    public function removeMeal($arrayKey)
    {
        $this->subtractMacros($arrayKey);
        \array_splice($this->dayArray[$this->day], $arrayKey, 1);
    }

    public function calculateMakrosNew()
    {
        foreach($this->dayArray[$this->day] as $key => $value){
            $this->additionHelpFunction($key);
        }
    }

    public function recalculateMacrosEdited($arrayKey)
    {
        $this->additionHelpFunction($arrayKey);
    }

    public function subtractMacros($arrayKey)
    {
        $this->subtractHelpFunction($arrayKey);
    }

    /*********************************************
     * Submit Functions
     *********************************************/

    public function savePlan()
    {
        //Plan Creation
        $plan = new Plan();
        $plan->name = $this->planName;
        $plan->aim = $this->aimSelection;
        $plan->comment = $this->planComment;
        $plan->athlete_id = $this->athlete;
        $plan->start_date = $this->start_date;
        $plan->end_date = $this->end_date;
        $plan->save();

        foreach ($this->dayArray as $key => $day) {
            foreach ($day as $meal) {
                // Create Plan Meals pivot
                $id = DB::table('plan_meals')->insertGetId([
                    'plan_id' => $plan->id,
                    'meal_id' => $meal['id'],
                    'day' => $key + 1,
                    'daytime' => $meal['dayTime']
                ]);

                foreach ($meal[0] as $ing) {
                    // Create Ingredients linked to Plan Meals Pivot
                    DB::table('plan_meal_ingredients')->insert([
                        'plan_meal_id' => $id,
                        'ingredient_id' => $ing['id'],
                        'final_amount' => $ing['amount'],
                        'unit' => $ing['unit'],
                    ]);
                }
            }
        }

        session()->flash('successMessage', 'Plan has been created successfully.');

        $this->redirectRoute('planAdd');

    }


    /*********************************************
     * Helping Functions
     *********************************************/

    public function additionHelpFunction($arrayKey)
    {
        $kcal = 0;
        $carbs = 0;
        $protein = 0;
        $fat = 0;

        foreach ($this->dayArray[$this->day][$arrayKey][0] as $key => $aMeal) {
            $ing = Ingredient::where('id', $aMeal['id'])->firstOrFail();
            $kcal += ($aMeal['amount'] / 100) * $ing->kcal;
            $carbs += ($aMeal['amount'] / 100) * $ing->carbs;
            $protein += ($aMeal['amount'] / 100) * $ing->protein;
            $fat += ($aMeal['amount'] / 100) * $ing->fat;
        }

        $this->finalKcal += $kcal;
        $this->finalCarbs += $carbs;
        $this->finalProtein += $protein;
        $this->finalFat += $fat;
    }

    public function subtractHelpFunction($arrayKey)
    {
        $kcal = 0;
        $carbs = 0;
        $protein = 0;
        $fat = 0;

        foreach ($this->dayArray[$this->day][$arrayKey][0] as $key => $aMeal) {
            $ing = Ingredient::where('id', $aMeal['id'])->firstOrFail();
            $kcal += ($aMeal['amount'] / 100) * $ing->kcal;
            $carbs += ($aMeal['amount'] / 100) * $ing->carbs;
            $protein += ($aMeal['amount'] / 100) * $ing->protein;
            $fat += ($aMeal['amount'] / 100) * $ing->fat;
        }

        $this->finalKcal -= $kcal;
        $this->finalCarbs -= $carbs;
        $this->finalProtein -= $protein;
        $this->finalFat -= $fat;
    }

    public function calculateKcal(int $mealId)
    {
        $kcal = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach ($ings as $ing) {
            $kcal += ($ing->amount / 100) * $ing->kcal;
        }
        return $kcal;
    }

    public function calculateCarbs(int $mealId)
    {
        $carbs = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach ($ings as $ing) {
            $carbs += ($ing->amount / 100) * $ing->carbs;
        }
        return $carbs;
    }

    public function calculateProtein(int $mealId)
    {
        $protein = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach ($ings as $ing) {
            $protein += ($ing->amount / 100) * $ing->protein;
        }
        return $protein;
    }

    public function calculateFat(int $mealId)
    {
        $fat = 0;
        $ings = Ingredient::calcKcal($mealId);
        foreach ($ings as $ing) {
            $fat += ($ing->amount / 100) * $ing->fat;
        }
        return $fat;
    }

    public function render()
    {
        return view('livewire.add-plan', [
            'athletes' => Athlete::all()
        ], [
            'meals' => Meal::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage)
        ]);
    }
}
