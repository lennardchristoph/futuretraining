<?php

namespace App\Http\Livewire;

use App\Models\Athlete;
use Livewire\Component;

class AddAthlete extends Component
{

    //Athlete
    public $surname, $name, $height, $weight, $age, $sportexperience, $level, $frequency, $sleeptime, $incompatibility, $actualkcal, $aim;

    //Validation Rules
    protected $rules = [
        'surname' => 'required|max:255',
        'name' => 'required|max:255',
        'age' => 'required|numeric',
        'height' => 'required|numeric',
        'weight' => 'required|numeric',
        'sportexperience' => 'required',
        'level' => 'required|numeric',
        'frequency' => 'required|numeric',
        'sleeptime' => 'numeric',
        'actualkcal' => 'required|numeric',
        'aim' => 'required|numeric'

    ];

    public function render()
    {
        return view('livewire.add-athlete');
    }

    //Submit Form
    public function submit(){
        $this->validate();

        $athlete = new Athlete;

        $athlete->surname = $this->surname;
        $athlete->lastname = $this->name;
        $athlete->age = $this->age;
        $athlete->height = $this->height;
        $athlete->weight = $this->weight;
        $athlete->sportexperience = $this->sportexperience;
        $athlete->frequency = $this->frequency;
        $athlete->sleeptime = $this->sleeptime;
        $athlete->incompatibility = false;
        $athlete->actualkcal = $this->actualkcal;
        $athlete->level = $this->level;
        $athlete->aim = $this->aim;

        $athlete->save();

        session()->flash('message', 'Athlete has been created successfully.');

        $this->redirectRoute('athleteAdd');
    }
}
