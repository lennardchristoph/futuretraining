<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class nutritionController extends Controller
{
    /*==============================================================
                            BEGIN Ingredients Views
     ==============================================================*/
    public function indexIngredientList(){
        return view('ingredientviews.list');
    }

    public function indexIngredientAddSingle() {
        return view('ingredientviews.add');
    }

    public function indexIngredientAddMany() {
        return view('ingredientviews.upload');
    }

    public function ingredientsAddMany(Request $request){

        $request->validate([
            'ingredientsFile' => 'required'
        ]);

        if ($request->input('submit') != null ){

            $file = $request->file('file');

            // File Details
            $filename = $request->ingredientsFile->getClientOriginalName();
            $tempPath = $request->ingredientsFile->getRealPath();
            // Reading file
            $file = fopen($tempPath,"r");

            $importData_arr = array();
            $i = 0;

            while (($filedata = fgetcsv($file, 5000, ";")) !== FALSE) {
                $num = count($filedata );

                // Skip first row (Remove below comment if you want to skip the first row)
                if(isset($request->header)){
                    if($i == 0){
                        $i++;
                        continue;
                    }
                }

                for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                }
                $i++;
            }
            fclose($file);

            // Insert to MySQL database
            foreach($importData_arr as $importData){

                $i = new Ingredient();
                $i->name = $importData[0];
                $i->kcal = $importData[1];
                $i->carbs = $importData[2];
                $i->protein = $importData[3];
                $i->fat = $importData[4];
                $i->amount = $importData[5];
                $i->unity = $importData[6];
                $i->lactose_intolerance = $importData[7];
                $i->gluten_intolerance = $importData[8];

                $i->save();
            }


        }
        // Redirect to index
        return back()->with('successUpload', 'The file has been uploaded successfully!');
    }

    /*==============================================================
                            BEGIN Meal Views
     ==============================================================*/

    public function indexMealList() {
        return view('mealviews.list');
    }

    public function indexMealAddSingle() {
        return view('mealviews.addMeal');
    }

    public function indexPlanList(){
        return view('nutritionplanviews.list');
    }

    public function indexPlanAddSingle() {
        return view('nutritionplanviews.addPlan');
    }
}
