<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Animal as AnimalModell;
use App\Models\Shelter;
use App\Models\Species;
use App\Models\Vaccine;

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
     * This method is called when the user selects a species from the dropdown.
     * It queries the database for animals of the selected species.
     */

    public function updatedSelectedSpecies($name)
    {
        $query = AnimalModell::with('images')
            ->whereHas('species', function ($q) use ($name) {
                $q->where('name', $name);
            });
        if ($this->shelterId !== null) {
            $query->where('shelter_id', $this->shelterId);
        }
        $this->animals = $query->limit($this->limit)->get();
    }

    /**
     * This method is responsible for the detailed filtering of animals.
     */

    public function filterAnimals(): void
    {
        $query = AnimalModell::with(['images', 'shelter', 'species']);

        if ($this->selectedSpecies) {
            $query->whereHas('species', function ($q) {
                $q->where('name', $this->selectedSpecies);
            });
        }

        if ($this->sex) {
            $query->where('sex', $this->sex);
        }

        if ($this->age) {
            switch ($this->age) {
                case '<1':
                    $query->where('age', '<', 1);
                    break;
                case '1-5':
                    $query->whereBetween('age', [1, 5]);
                    break;
                case '>5':
                    $query->where('age', '>', 5);
                    break;
            }
        }

        if (!empty($this->color)) {
            $query->where('color', $this->color);
        }

        if (!empty($this->vaccine)) {
            $query->whereHas('vaccines', function ($q) {
                $q->whereIn('name', $this->vaccine);
            });
        }

        if (!empty($this->city)) {
            $query->whereHas('shelter', function ($q) {
                $q->whereIn('city', $this->city);
            });
        }

        $this->animals = $query->get();
    }

    /**
     * This function deletes the selected filters in he detailed filters section.
     */

    public function deleteFilters()
    {
        $this->selectedSpecies = '';
        $this->sex = null;
        $this->age = null;
        $this->color = [];
        $this->vaccine = [];
        $this->city = [];
        $this->loadMore();
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
