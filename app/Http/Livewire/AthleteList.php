<?php

namespace App\Http\Livewire;

use App\Models\Athlete;
use Livewire\Component;
use Livewire\WithPagination;

class AthleteList extends Component
{
    use WithPagination;

    public $perPage = 20;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.athlete-list', [
            'athletes' => Athlete::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage)
        ]);
    }
}
