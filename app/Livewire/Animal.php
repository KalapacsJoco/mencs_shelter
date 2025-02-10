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
    public $animals=[];
    public $allAnimals=[];

    /**
     * This method counts the Animal instanses and loads the first $limit number of animals
     */

    public function mount($animals, $shelterId = null): void
    {
        $this->shelterId = $shelterId;
        $this->animals = collect($this->allAnimals)->take($this->limit);
        $this->allAnimals= $animals;
        $this->totalAnimals = AnimalModell::count();
        $this->loadMore();
        $this->species = Species::pluck('name');
        $this->colors = AnimalModell::pluck('color')->unique();
        $this->vaccines = Vaccine::pluck('name');
        $this->cityes = Shelter::pluck('city')->unique();
    }

    /**
     * This method loads more $limit number of animals from the database
     */
    
     public function loadMore(): void
    {
        $this->limit += 12;
        $this->animals = collect($this->allAnimals)->take($this->limit);
    }

    /**
     * This method filters the animals by the selected species
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

        $this->animals = $query->take($this->limit)->get();
    }

    /**
     * This method filters the animals by the selected criteria
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
            $query->whereIn('color', $this->color);
        }

        if (!empty($this->vaccine)) {
            $query->whereIn('vaccine', $this->vaccine);
        }

        if (!empty($this->city)) {
            $query->whereHas('shelter', function ($q) {
                $q->whereIn('city', $this->city);
            });
        }

        $this->animals = $query->limit($this->limit)->get();
    }

    /**
     * This method renders the Animal component
     */

    public function render()
    {
        return view('livewire.animal', [
            'animals' => $this->animals,
            'colors' => $this->colors,
            'vaccines' => $this->vaccines,
            'cityes' => $this->cityes,
            'species' => $this->species,
        ]);
    }
}