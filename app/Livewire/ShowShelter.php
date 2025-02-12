<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use App\Models\Shelter;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\WithPagination;

/**
 * This class is responsible for rendering the shelter instance to the show page with pagination.
 */

class ShowShelter extends Component
{
    /**
     * This trait allows to paginate the data.
     */
    use WithPagination;

    /**
     * This variable will store the shelter instance.
     */
    public Shelter $shelter;

    /**
     * This variable will store the animals id that match the criteria.
     */
    public $animalIds = [];

    /**
     * This function will redirect the user to the animal show page
     */

    public function redirectToAnimal(int $id): RedirectResponse
    {
        return redirect()->route('animal.show', $id);
    }

    /**
     * This method accepts the filtered data and returns the animals id that match the criteria
     */

    #[On('animalFilterUpdated')]
    public function filteredAnimals(int $animalIds): void
    {
        $this->animalIds = $animalIds;
    }

    /**
     * This method deletes the filters and returns all the shelter`s animals
     */
    #[On('filtersDeleted')]
    public function deleteFilters(): void
    {
        $this->animalIds = [];
    }

    /**
     * This function renders the shelter instance to the show page with pagination
     */

    public function render(): View
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
