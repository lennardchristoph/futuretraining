<?php

namespace App\Http\Livewire;

use App\Models\Ingredient;
use BabyMarkt\DeepL\DeepL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Meal;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class MealUpload extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $perPage = 25;
    public $sortField = 'id';
    public $sortAsc = true;
    public $step;
    public $submitGo = false;

    //Meal
    public $mealName, $mealDescription, $mealImage;

    //IngModal
    public $ingId, $name, $massUnit, $ingAmount;
    public $addingIngs = [];

    //Validation Rules
    protected $rules = [
        'mealName' => 'required|max:255',
        'mealImage' => 'required|image|mimes:jpg,png,jpeg|max:2048',
    ];

    public function mount()
    {
        $this->step = 0;
        $this->massUnit = 1;
    }

    public function increaseStep()
    {
        $this->validate();
        $this->step++;
    }

    public function decreaseStep()
    {
        $this->step--;
    }

    //Render View
    public function render()
    {
        return view('livewire.meal-upload', [
            'ingredients' => Ingredient::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage)
        ], [
            'units' => DB::table('units')->get()
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'mealName' => 'required|max:100',
            'mealImage' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    }

    public function updatedPhoto()
    {
        $this->validate([
            'mealImage' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    }

    public function openIngModal($ingID)
    {
        $ingredient = Ingredient::where('id', $ingID)->firstOrFail();
        $this->ingId = $ingredient->id;
        $this->name = $ingredient->name;
    }

    public function addIngredient($ingID)
    {
        $validatedData = $this->validate([
            'ingAmount' => 'required|numeric',
            'massUnit' => 'required|numeric'
        ]);
        array_push($this->addingIngs, ['id' => $this->ingId, 'ingAmount' => $this->ingAmount, 'massUnit' => $this->massUnit]);
        if (count($this->addingIngs)) {
            $this->submitGo = true;
        }
    }

    //Submit Form
    public function submit()
    {
        $this->validate();

        $meal = new Meal;
        $deepl   = new DeepL('73a46880-b5c9-22c4-46c5-7da7d8b59f19:fx');

        switch (App::currentLocale()) {
            case 'de':
                //deutsch
                $meal->de_title = $this->mealName;
                $meal->de_description = $this->mealDescription;
                //englisch
                $meal->en_title = $deepl->translate($this->mealName, 'de', 'en')[0]['text'];
                $meal->en_description = $deepl->translate($this->mealDescription, 'de', 'en')[0]['text'];
                //french
                $meal->fr_title = $deepl->translate($this->mealName, 'de', 'fr')[0]['text'];
                $meal->fr_description = $deepl->translate($this->mealDescription, 'de', 'fr')[0]['text'];
                //spanish
                $meal->es_title = $deepl->translate($this->mealName, 'de', 'es')[0]['text'];
                $meal->es_description = $deepl->translate($this->mealDescription, 'de', 'es')[0]['text'];
                break;

            case 'en':
                //english
                $meal->en_title = $this->mealName;
                $meal->en_description = $this->mealDescription;
                //german
                $meal->de_title = $deepl->translate($this->mealName, 'en', 'de')[0]['text'];
                $meal->de_description = $deepl->translate($this->mealDescription, 'en', 'de')[0]['text'];
                //french
                $meal->fr_title = $deepl->translate($this->mealName, 'en', 'fr')[0]['text'];
                $meal->fr_description = $deepl->translate($this->mealDescription, 'en', 'fr')[0]['text'];
                //spanish
                $meal->es_title = $deepl->translate($this->mealName, 'en', 'es')[0]['text'];
                $meal->es_description = $deepl->translate($this->mealDescription, 'en', 'es')[0]['text'];
                break;

            case 'fr':
                //french
                $meal->fr_title = $this->mealName;
                $meal->fr_description = $this->mealDescription;
                //german
                $meal->de_title = $deepl->translate($this->mealName, 'fr', 'de')[0]['text'];
                $meal->de_description = $deepl->translate($this->mealDescription, 'fr', 'de')[0]['text'];
                //english
                $meal->en_title = $deepl->translate($this->mealName, 'fr', 'en')[0]['text'];
                $meal->en_description = $deepl->translate($this->mealDescription, 'fr', 'en')[0]['text'];
                //spanish
                $meal->es_title = $deepl->translate($this->mealName, 'fr', 'es')[0]['text'];
                $meal->es_description = $deepl->translate($this->mealDescription, 'fr', 'es')[0]['text'];
                break;

            case 'es':
                //french
                $meal->es_title = $this->mealName;
                $meal->es_description = $this->mealDescription;
                //german
                $meal->de_title = $deepl->translate($this->mealName, 'es', 'de')[0]['text'];
                $meal->de_description = $deepl->translate($this->mealDescription, 'es', 'de')[0]['text'];
                //french
                $meal->en_title = $deepl->translate($this->mealName, 'es', 'fr')[0]['text'];
                $meal->en_description = $deepl->translate($this->mealDescription, 'es', 'fr')[0]['text'];
                //spanish
                $meal->fr_title = $deepl->translate($this->mealName, 'es', 'es')[0]['text'];
                $meal->fr_description = $deepl->translate($this->mealDescription, 'es', 'es')[0]['text'];
                break;
        }
        /* MEAL IMAGE */
        $imageUUID = Str::uuid();
        $path = $this->mealImage->storeAs('/uploads/mealImages', $imageUUID);
        $meal->image = '/storage/' . $path;

        $meal->save();

        foreach($this->addingIngs as $ings){
            DB::table('meal_ingredients')->insert([
                'meal_id' => $meal->id,
                'ingredient_id' => $ings['id'],
                'amount' => $ings['ingAmount'],
                'unit' => $ings['massUnit']
            ]);
        }

        session()->flash('message', 'Meal has been created successfully.');

        $this->redirectRoute('mealAdd');

    }

}
