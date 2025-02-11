<?php

namespace App\Livewire;

use App\Models\Animal;
use App\Models\Species;
use App\Models\Vaccine;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListAnimals extends Component
{
    use WithPagination;

    public $animalIds = [];
    public $species = Species::class;
    public $colors = Animal::class;
    public $vaccines = Vaccine::class;
    public $cityes = Shelter::class;


    /**
     * This method will redirect the user to the animal show page
     */

    public function redirectToAnimal($id)
    {
        return redirect()->route('animal.show', $id);
    }

    /**
     * This method accepts the filtered data and returns the animals id that match the criteria
     */

    #[On('animalFilterUpdated')]
    public function filteredAnimals($animalIds)
    {
        $this->animalIds = $animalIds;
    }

    /**
     * This method deletes the filters and returns all the shelter`s animals
     */

    #[On('filtersDeleted')]
    public function deleteFilters()
    {
        $this->animalIds = [];
    }

    /**
     * This method renders the list of animals... if the filters are applied it will return the filtered animals with pagination
     */

    public function render()
    {
        $query = Animal::with(['images', 'shelter', 'species']);

        if (!empty($this->animalIds)) {
            $query->whereIn('id', $this->animalIds);
        }
        return view('livewire.list-animals', [
            'animals' => $query->paginate(16), 
        ]);
    }
}
