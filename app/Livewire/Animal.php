<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Animal as AnimalModell;
use App\Models\Species;

class Animal extends Component
{
    public $animals = [];
    public $limit = 3;
    public $totalAnimals;
    public $selectedSpecies = '';
    public $species;
    public $colors;
    public $shelterId = null;

    /**
     * This method counts the Animal instanses and loads the first $limit number of Animals
     */

    public function mount($shelterId = null): void
    {
        $this->totalAnimals = AnimalModell::count();
        $this->loadMore();
        $this->species = Species::pluck('name');
        $this->colors = AnimalModell::pluck('color');
        $this->shelterId = $shelterId;
    }

    /**
     * This method redirects to the Animal`s own site through the router
     */

    public function goToAnimal($animalId)
    {
        return redirect()->route('animals.show', $animalId);
    }

    /**
     * This method loads more $limit number of Animals from the database
     */

     public function loadMore(): void
     {
         $query = AnimalModell::with('images');
              if ($this->shelterId) {
             $query->where('shelter_id', $this->shelterId);
             $this->totalAnimals = AnimalModell::where('shelter_id', $this->shelterId)->count();
         } else {
             $this->totalAnimals = AnimalModell::count();
         }
         $this->animals = $query->take($this->limit)->get();
         $this->limit += 3;
     }
     

    /**
     * This method filters the animals selected by the species
     */

    public function updatedSelectedSpecies($name)
    {
        $this->animals = AnimalModell::with('images')
            ->whereHas('species', function ($q) use ($name) {
                $q->where('name', $name);
            })
            ->take($this->limit)
            ->get();
    }

    /**
     * This method renders the Animal cards to the dashboard site
     */

    public function render()
    {
        return view('livewire.animal', [
            'animals' => $this->animals
        ]);
    }
}
