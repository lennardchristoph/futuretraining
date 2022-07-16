<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class athleteController extends Controller
{
    /*==============================================================
                            Begin Athlete Views
     ==============================================================*/
    public function indexAthleteList() {
        return view('athleteviews.athleteList');
    }

    public function indexAthleteAddSingle() {
        return view('athleteviews.athleteAdd');
    }
}
