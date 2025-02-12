<?php

namespace App\Livewire;

use App\Models\Animal;
use App\Models\Shelter;
use App\Models\Species;
use App\Models\Vaccine;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

/**
 * This class is responsible for the filtering logic of the animals. It is reusable and can be used on different pages.
 */

class AnimalFilter extends Component
{
    /**
     * The selected species from the dropdown.
     */

    public ?string $selectedSpecies = null;

    /**
     * All the species found in database
     */

    public Collection $species;

    /**
     * The selected age from the dropdown.
     */

    public ?string $age = null;

    /**
     * The selected sex from the dropdown.
     */

    public ?string $sex = null;

    /**
     * The available colors from the database.
     */

    public Collection $colors;

    /**
     * The available vaccines from the database.
     */

    public Collection $vaccines;

    /**
     * The available cities of the shelters. In the Shelter component this option is disabled.
     */

    public Collection $cityes;

    /**
     * The selected colors from the checkbox.
     */

    public array $color = [];

    /**
     * The selected vaccines from the checkbox.
     */

    public array $vaccine = [];

    /**
     * The selected cities from the checkbox.
     */

    public array $city = [];

    /**
     * The id of the shelter. If the filter is used in the Shelter component, the id is passed as a parameter.
     */

    public ?int $shelterId = null;

    /**
     * The list of animals that match the selected filters.
     */

    public Collection $animals;

    /**
     * This method gets the filter informations from the database. 
     * Also sets the shelter id if it is passed as a parameter.
     */

    public function mount(?int $shelterId = null): void
    {
        $this->shelterId = $shelterId;
        $this->species   = Species::pluck('name', 'id');
        $this->colors    = Animal::pluck('color')->unique();
        $this->vaccines  = Vaccine::pluck('name');
        $this->cityes    = Shelter::pluck('city')->unique();
    }

    /**
     * This method is called when the user selects a species from the dropdown.
     * It queries the database for animals of the selected species.
     */

    public function updatedSelectedSpecies(int $id): void
    {
        $query = Animal::with('images')
            ->whereHas('species', function ($q) use ($id) {
                $q->where('id', $id);
            });
        if ($id == 'all') {
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

    public function deleteFilters(): void
    {
        $this->dispatch('filtersDeleted');
    }

    /**
     * This method renders the searchbar and the detailed filters.
     */

    public function render(): View
    {
        return view('livewire.animal-filter');
    }
}
