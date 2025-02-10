<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shelter as ShelterModell;

class Shelter extends Component
{
    public $shelters = [];
    public $limit = 3;
    public $totalShelters;
    public $animals;

    /**
     * This method counts the Shelter instanses and loads the first $limit number of shelters
     */

    public function mount($animals): void
    {
        $this->animals = $animals;
        $this->totalShelters = ShelterModell::count();
        $this->loadMore();
    }

    /**
     * This method redirects to the shelter`s own site through the router
     */

    public function goToShelter($shelterId)
    {

        return redirect()->route('shelters.show', $shelterId);
    }

    /**
     * This method loads more $limit number of shelters from the database
     */

    public function loadMore(): void
    {
        if (count($this->shelters) < $this->totalShelters) {
            $this->shelters = ShelterModell::with('images')->take($this->limit)->get();
            $this->limit += 3;
        }
    }

    /**
     * This method renders the Shelter cards to the dashboard site
     */

    public function render()
    {
        return view('livewire.shelter',);
    }
}
