<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shelter as ShelterModell; 

class Shelter extends Component
{
    public $shelters = [];
    public $limit = 3;
    public $totalShelters;

    public function mount()
    {
        $this->totalShelters = ShelterModell::count(); 
        $this->loadMore();
    }

    public function loadMore()
    {
        if (count($this->shelters) < $this->totalShelters) {
            $this->shelters = ShelterModell::with('images')->take($this->limit)->get();
            $this->limit += 3;
        }
    }

    public function render()
    {
        return view('livewire.shelter');
    }
}
