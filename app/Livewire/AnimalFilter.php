<?php

namespace App\Livewire;

use App\Models\Animal;
use App\Models\Shelter;
use App\Models\Species;
use App\Models\Vaccine;
use Livewire\Component;

class AnimalFilter extends Component
{
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

    public function mount($shelterId = null): void
    {
        $this->shelterId = $shelterId;
        $this->species   = Species::pluck('name');
        $this->colors    = Animal::pluck('color')->unique();
        $this->vaccines  = Vaccine::pluck('name');
        $this->cityes    = Shelter::pluck('city')->unique();
    }

    /**
     * This method is called when the user selects a species from the dropdown.
     * It queries the database for animals of the selected species.
     */

    public function updatedSelectedSpecies($name)
    {
        $query = Animal::with('images')
            ->whereHas('species', function ($q) use ($name) {
                $q->where('name', $name);
            });
        if ($name=='all') {
            $query = Animal::with('images');
        }
        if ($this->shelterId !== null) {
            $query->where('shelter_id', $this->shelterId);
        }
        $this->animals = $query->get();
        $animalIds = collect($this->animals)->flatten(1)->pluck('id')->toArray();
        $this->dispatch('animalFilterUpdated', $animalIds);
    }

    /**
     * This method is responsible for the detailed filtering of animals.
     */

    public function filterAnimals(): void
    {
        $query = Animal::with(['images', 'shelter', 'species']);

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
        $animalIds = collect($this->animals)->flatten(1)->pluck('id')->toArray();
        $this->dispatch('animalFilterUpdated', $animalIds);
        
    }

    /**
     * This function deletes the selected filters in he detailed filters section.
     */

    public function deleteFilters()
    {
        $this->dispatch('filtersDeleted');   
    }

    /**
     * This method renders the searchbar and the detailed filters.
     */

    public function render()
    {
        return view('livewire.animal-filter');
    }
}
