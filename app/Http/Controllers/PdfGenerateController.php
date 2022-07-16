<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\DB;

class PdfGenerateController extends Controller
{
    public function planPdfView(Request $request)
    {
        $dayArray = [];
        $day = [];

        for($i = 0; $i <= 6; $i++) {
            array_push($dayArray, $day);
        }
        // TODO: Wird angepasst sobald man den Plan aus der "PLAN" Liste drucken kann
        $plan = Plan::where('id', 1)->firstOrFail();

        $meals = DB::table('plan_meals')
            ->join('meals', 'plan_meals.meal_id', '=', 'meals.id')
            ->select('*')
            ->orderBy('day')
            ->orderBy('daytime')
            ->get();

        foreach($meals as $meal) {
            array_push($dayArray[$meal->day-1], $meal);
        }
        dd($dayArray);

        $athlete = Athlete::where('id', $plan->athlete_id)->firstOrFail();
        // TODO: Plan anpassen, dass der Plan zu einem Trainer zugeordnet wird
        $trainer = User::where('id', 1)->firstOrFail();
        if($request->has('download')) {
            // pass view file
            $pdf = Pdf::loadView('pdf.nutritionplan', ['plan'=>$plan, 'athlete'=>$athlete, 'trainer'=>$trainer]);
            // download pdf
            return $pdf->download('plan.pdf');
        }
        return view('pdf.nutritionplan', [
            'plan' => $plan,
            'meals' => $meals,
            'athlete'=>$athlete,
            'trainer'=>$trainer
        ]);
    }

    private function calculateMacros() {

    }
}
