<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use App\Models\Shelter;
use App\Models\Species;
use App\Models\Vaccine;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ShowShelter extends Component
{

    use WithPagination;

    public Shelter $shelter;
    public $animalIds = [];
    public $species = Species::class;
    public $colors = Animal::class;
    public $vaccines = Vaccine::class;
    public $cityes = Shelter::class;

    /**
     * This function recieves the shelter instance witch has to be rendered to the show page
     */

    public function mount(Shelter $shelter)
    {
        $this->shelter = $shelter;

    }

    /**
     * This function will redirect the user to the animal show page
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
     * This function renders the shelter instance to the show page with pagination
     */

     public function render()
     {
         $query = Animal::with(['images', 'shelter', 'species'])
             ->where('shelter_id', $this->shelter->id);
 
         if (!empty($this->animalIds)) {
             $query->whereIn('id', $this->animalIds);
         }
 
         return view('livewire.show-shelter', [
             'animals' => $query->paginate(8), 
         ]);
     }
}
