<?php

namespace App\Http\Livewire;

use App\Models\Ingredient;
use BabyMarkt\DeepL\DeepL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use OpenFoodFacts\Laravel\Facades\OpenFoodFacts;

class AddIngredient extends Component
{
    //Ing Attributes
    public $ingName, $ingKcal, $ingCarbs, $ingProtein, $ingFat, $ingUnity, $lactose, $gluten;

    //Validation Rules
    protected $rules = [
        'ingName' => 'required|max:255',
        'ingKcal' => 'required|numeric',
        'ingCarbs' => 'required|numeric',
        'ingProtein' => 'required|numeric',
        'ingFat' => 'required|numeric',
        'ingUnity' => 'required|numeric'
    ];

    public function render()
    {
        return view('livewire.add-ingredient', [
            'units' => DB::table('units')->get()
        ]);
    }

    //Submit Form
    public function submit(){
        $this->validate();

        $ing = new Ingredient;
        $deepl   = new DeepL('73a46880-b5c9-22c4-46c5-7da7d8b59f19:fx');
        switch (App::currentLocale()) {
            case 'de':
                $ing->de_name = $this->ingName;
                $ing->en_name = $deepl->translate($this->ingName, 'de', 'en')[0]['text'];
                $ing->fr_name = $deepl->translate($this->ingName, 'de', 'fr')[0]['text'];
                $ing->es_name = $deepl->translate($this->ingName, 'de', 'es')[0]['text'];
                break;

            case 'en':
                $ing->en_name = $this->ingName;
                $ing->de_name = $deepl->translate($this->ingName, 'en', 'de')[0]['text'];
                $ing->fr_name = $deepl->translate($this->ingName, 'en', 'fr')[0]['text'];
                $ing->es_name = $deepl->translate($this->ingName, 'en', 'es')[0]['text'];
                break;

            case 'fr':
                $ing->fr_name = $this->ingName;
                $ing->de_name = $deepl->translate($this->ingName, 'fr', 'de')[0]['text'];
                $ing->en_name = $deepl->translate($this->ingName, 'fr', 'en')[0]['text'];
                $ing->es_name = $deepl->translate($this->ingName, 'fr', 'es')[0]['text'];
                break;

            case 'es':
                $ing->es_name = $this->ingName;
                $ing->de_name = $deepl->translate($this->ingName, 'es', 'de')[0]['text'];
                $ing->en_name = $deepl->translate($this->ingName, 'es', 'en')[0]['text'];
                $ing->fr_name = $deepl->translate($this->ingName, 'es', 'fr')[0]['text'];
                break;
        }

        $ing->kcal = $this->ingKcal;
        $ing->carbs = $this->ingCarbs;
        $ing->protein = $this->ingProtein;
        $ing->fat = $this->ingFat;
        $ing->amount = 100;
        $ing->unity = $this->ingUnity;

        if($this->lactose == 'true') {
            $ing->lactose_intolerance = true;
        }
        if($this->gluten == 'true') {
            $ing->gluten_intolerance = true;
        }

        $ing->save();

        session()->flash('message', 'Ingredient has been created successfully.');

        $this->redirectRoute('ingredientAdd');
    }
}
