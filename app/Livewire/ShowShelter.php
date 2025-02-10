<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shelter;
use Livewire\WithPagination;

class ShowShelter extends Component
{

    use WithPagination;

    public Shelter $shelter;
    public $animals;

    /**
     * This function recieves the shelter instance witch has to be rendered to the show page
     */

    public function mount(Shelter $shelter)
    {
        $this->shelter = $shelter;
        $this->animals = $shelter->animals;
    }

    /**
     * This function renders the shelter instance to the show page
     */

    public function render()
    {
        return view('livewire.show-shelter',[
            'animals' => $this->shelter->animals()->paginate(3),
        ]);
    }
}
