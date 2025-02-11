<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Animal as AnimalModell;
use App\Models\Shelter;
use App\Models\Species;
use App\Models\Vaccine;
use Livewire\Attributes\On;

class Animal extends Component
{
    public $limit;
    public $totalAnimals;
    public $selectedSpecies = '';
    public $species;
    public $age;
    public $sex;
    public $colors;
    public $vaccines;
    public $cityes;
    public $color = [];
    public $vaccine = [];
    public $city = [];
    public $shelterId = null;
    public $animals = [];

    /**
     * Mount queries the database to get the initial 5 animals and supporting data.
     */

    public function mount($shelterId = null): void
    {
        $this->limit = 5;
        $this->shelterId = $shelterId;
        $this->totalAnimals = AnimalModell::count();
        $this->species   = Species::pluck('name');
        $this->colors    = AnimalModell::pluck('color')->unique();
        $this->vaccines  = Vaccine::pluck('name');
        $this->cityes    = Shelter::pluck('city')->unique();
    }

    /**
     * The dashboard loads the first x number of animals when the page is loaded. If the user wants to see more, this
     * method is responsible for it.
     */

    public function loadMore(): void
    {
        $this->limit += 5;
        $query = AnimalModell::with(['images', 'shelter', 'species']);

        if ($this->shelterId !== null) {
            $query->where('shelter_id', $this->shelterId);
        }
        $this->animals = $query->limit($this->limit)->get();
    }

    /**
     * This method redirects to the animal`s own site through the router if the user clicks on the animal card.
     */

     #[On('animalFilterUpdated')]
     public function filteredAnimals($animalIds)
     {
         $this->animals = AnimalModell::with(['images', 'shelter', 'species'])
                                      ->whereIn('id', $animalIds)
                                      ->get();
     }

         /**
     * This method deletes the filters and returns all the shelter`s animals
     */

    #[On('filtersDeleted')]
    public function deleteFilters()
    {
        $this->animals = AnimalModell::with(['images', 'shelter', 'species'])
                                     ->limit($this->limit)
                                     ->get();
    }

    /**
     * This method redirects to the animal`s own site through the router if the user clicks on the animal card.
     */

    public function redirectToAnimal($id)
    {
        return redirect()->route('animal.show', $id);
    }

    /**
     * This method renders the animal cards to the dashboard site.
     */
    
    public function render()
    {
        return view('livewire.animal', [
            'animals'  => $this->animals,
            'colors'   => $this->colors,
            'vaccines' => $this->vaccines,
            'cityes'   => $this->cityes,
            'species'  => $this->species,
        ]);
    }
}
