<?php

namespace App\Http\Livewire;

use App\Models\Athlete;
use App\Models\Plan;
use Livewire\Component;

class PlanList extends Component
{
    /*********************************************
     * Pagination Variables
     *********************************************/

    public $search = '';
    public $sortField = 'id';
    public $sortAsc = true;
    public $perPage = 5;



    public function render()
    {
        return view('livewire.plan-list', [
            'plans' => Plan::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage)
        ]);
    }
}
