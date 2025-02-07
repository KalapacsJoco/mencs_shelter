<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shelter;

class ShowShelter extends Component
{
    public Shelter $shelter;

    /**
     * This function recieves the shelter instance witch has to be rendered to the show page
     */

    public function mount(Shelter $shelter)
    {
        $this->shelter = $shelter;
    }

    /**
     * This function renders the shelter instance to the show page
     */

    public function render()
    {
        return view('livewire.show-shelter');
    }
}
