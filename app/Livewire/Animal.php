<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Animal as AnimalModell;
use App\Models\Species;

class Animal extends Component
{
    public $animals = [];
    public $limit = 12;
    public $totalAnimals;
    public $selectedSpecies = '';
    public $species;
    public $colors;

    /**
     * This method counts the Animal instanses and loads the first $limit number of Animals
     */

    public function mount(): void
    {
        $this->totalAnimals = AnimalModell::count();
        $this->loadMore();
        $this->species = Species::pluck('name');
        $this->colors = AnimalModell::pluck('color');
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
         if (count($this->animals) < $this->totalAnimals) {
             $this->animals = AnimalModell::with('images')->take($this->limit)->get();
             $this->limit += 12;
         }
         
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
        return view('livewire.animal');
    }
}
