<?php

namespace App\Http\Livewire;

use App\Models\Ingredient;
use Livewire\Component;
use Livewire\WithPagination;

class IngredientList extends Component
{
    use WithPagination;

    public $perPage = 20;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.ingredient-list', [
            'ingredients' => Ingredient::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage)
        ]);
    }
}
