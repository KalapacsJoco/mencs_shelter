<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shelter as ShelterModell;
use Illuminate\Support\Collection;

/**
 * This class is responsible for the Shelter cards on the dashboard site.
 */

class ShelterCard extends Component
{

    /**
     * The loaded shelters from the database. 
     * If the user clicks on the load more button, the limit will be increased by $limit.
     */
    public $shelters = [];

    /**
     * The limit of the shelters to be loaded.
     */
    public int $limit = 3;

    /**
     * The total number of shelters in the database.
     */
    public int $totalShelters;

    /**
     * The animals, loaded from the parent component (dashboard).
     */
    public Collection $animals;

    /**
     * This method counts the Shelter instanses and loads the first $limit number of shelters
     */

    public function mount(Collection $animals): void
    {
        $this->animals = $animals;
        $this->totalShelters = ShelterModell::count();
        $this->loadMore();
    }

    /**
     * This method redirects to the shelter`s own site through the router
     */

    public function goToShelter(int $shelterId)
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
        return view('livewire.shelter-card');
    }
}
