<?php

namespace App\Livewire;

use App\Models\Animal;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


/**
 * This class is responsible for rendering the list of animals with pagination.
 */

class ListAnimals extends Component
{

    /**
     * This trait allows to paginate the data.
     */

    use WithPagination;

    /**
     * This variable will store the animals id that match the criteria.
     */

    public $animalIds = [];

    /**
     * This method will redirect the user to the animal show page
     */

    public function redirectToAnimal(int $id): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('animal.show', $id);
    }

    /**
     * This method accepts the filtered data and returns the animals id that match the criteria
     */

    #[On('animalFilterUpdated')]
    public function filteredAnimals($animalIds): void
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
     * This method renders the list of animals... if the filters are applied it will return the filtered animals with pagination
     */

    public function render(): View
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
