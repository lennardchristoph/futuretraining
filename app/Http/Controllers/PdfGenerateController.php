<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Support\Carbon;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\DB;

class PdfGenerateController extends Controller
{
    private $ingredients = [];

    public function planPdfView(Request $request, $planID)
    {
        $locale = app()->getLocale();
        $localeName = app()->getLocale().'_name';
        $this->ingredients = [];
        $dayArray = [];
        $day = [];

        for($i = 0; $i <= 6; $i++) {
            array_push($dayArray, $day);
        }
        // TODO: Wird angepasst sobald man den Plan aus der "PLAN" Liste drucken kann
        $plan = Plan::where('id', $planID)->firstOrFail();

        $meals = DB::table('plan_meals')->where('plan_id', $planID)
            ->join('meals', 'plan_meals.meal_id', '=', 'meals.id')
            ->select('meals.*', 'plan_meals.*')
            ->orderBy('day')
            ->orderBy('daytime')
            ->get();

        foreach($meals as $meal) {
            $meal = $this->addIngsAndMakros($meal);
            array_push($dayArray[$meal['day']-1], $meal);
        }
        //dd($dayArray);
        $athlete = Athlete::where('id', $plan->athlete_id)->firstOrFail();
        // TODO: Plan anpassen, dass der Plan zu einem Trainer zugeordnet wird
        $trainer = User::where('id', 1)->firstOrFail();
        if($request->has('download')) {
            $pdf = Pdf::loadView('pdf.nutritionplan', [
                'planID' => $planID,
                'plan'=>$plan,
                'days' => $dayArray,
                'ingredients' => $this->ingredients,
                'athlete'=>$athlete,
                'trainer'=>$trainer,
                'locale' => $locale,
                'localeName' => $localeName
            ]);
            $dateTime = Carbon::now()->format('Y-m-d');
            return $pdf->download($athlete->surname.'_'.$athlete->lastname.'_'.$dateTime.'_'.'plan.pdf');
        }

        return view('pdf.nutritionplan', [
            'planID' => $planID,
            'plan' => $plan,
            'days' => $dayArray,
            'ingredients' => $this->ingredients,
            'athlete'=>$athlete,
            'trainer'=>$trainer,
            'locale' => $locale,
            'localeName' => $localeName
        ]);
    }

    private function ingMakros($ingID) {
        $ingredient = Ingredient::where('id', $ingID)->firstOrFail();
        return $ingredient;
    }

    public function addIngsAndMakros($meal)
    {

        $ings = Meal::planIngredients($meal->id);

        foreach($ings as $ing) {
            $checkIfExists = false;
            foreach($this->ingredients as $ingredients) {
               if($ingredients->id == $ing->id) {
                   $checkIfExists = true;
                   $ingredients->final_amount += $ing->final_amount;
               }
            }
            if(!$checkIfExists) {
                array_push($this->ingredients, $ing);
            }

        }
        $updatedMeal = (array)$meal;
        array_push($updatedMeal, $ings);
        $kcal = 0;$carbs = 0;$protein = 0;$fat = 0;
        foreach ($updatedMeal[0] as $key => $aMeal) {

            $kcal += ($aMeal->final_amount / 100) * $aMeal->kcal;
            $carbs += ($aMeal->final_amount / 100) * $aMeal->carbs;
            $protein += ($aMeal->final_amount / 100) * $aMeal->protein;
            $fat += ($aMeal->final_amount / 100) * $aMeal->fat;
        }
        $finalCarbs =[$kcal, $carbs, $protein, $fat];
        array_push($updatedMeal, $finalCarbs);

        return $updatedMeal;
    }
}
