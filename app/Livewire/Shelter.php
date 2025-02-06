<?php

namespace App\Livewire;

use App\Models\Shelter as ModelsShelter;
use Livewire\Component;

class Shelter extends Component
{

    /**
     * This variable stores the shelter instances
     */

    public $shelters;

    /**
     * This function mounts all the shelters from the database, making it reachable for the component
     */

    public function mount()
    {
        $this->shelters = ModelsShelter::with('images')->get();
    }

    /**
     * This function renders the shelter resources for the blade file
     */

    public function render()
    {
        return view('livewire.shelter', []);
    }
}
