<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Animal as AnimalModell;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;

/**
 * This class is responsible for the animal cards on the dashboard site. The first 10 animals are loaded when the page is set up.
 */

class AnimalCard extends Component
{
    /**
     * The number of animals to be loaded initially and incrementally.
     */
    public int $limit;

    /**
     * The total number of animals in the database.
     */
    public int $totalAnimals;

    /**
     * The ID of the selected shelter. If null, all shelters are displayed.
     */
    public ?int $shelterId;

    /**
     * The list of animals currently displayed.
     */
    public Collection $animals;

    /**
     * The IDs of animals after filtering.
     */
    public array $filteredAnimalIds;

    /**
     * Mount queries the database to get the initial x animals and supporting data.
     */

    public function mount(?int $shelterId = null): void
    {
        $this->limit = 10;
        $this->shelterId = $shelterId;
        $this->totalAnimals = AnimalModell::count();
    }

    /**
     * The dashboard loads the first x number of animals when the page is loaded. If the user wants to see more, this
     * method is responsible for it.
     */

    public function loadMore(): void
    {
        $this->limit += 10;
        $query = AnimalModell::with(['images', 'shelter', 'species'])->limit($this->limit);

        if (!empty($this->filteredAnimalIds)) {
            $query->whereIn('id', $this->filteredAnimalIds);
        }
        $this->animals = $query->limit($this->limit)->get();
    }

    /**
     * This method redirects to the animal`s own site through the router if the user clicks on the animal card.
     */

    #[On('animalFilterUpdated')]
    public function filteredAnimals($animalIds): void
    {
        $this->filteredAnimalIds = $animalIds;
        $this->animals = AnimalModell::with(['images', 'shelter', 'species'])
            ->whereIn('id', $animalIds)
            ->limit($this->limit)
            ->get();
    }

    /**
     * This method deletes the filters and returns all the shelter`s animals
     */

    #[On('filtersDeleted')]
    public function deleteFilters(): void
    {
        $this->animals = AnimalModell::with(['images', 'shelter', 'species'])
            ->limit($this->limit)
            ->get();
    }

    /**
     * This method redirects to the animal`s own site through the router if the user clicks on the animal card.
     */

    public function redirectToAnimal(int $id): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('animal.show', $id);
    }

    /**
     * This method renders the animal cards to the dashboard site.
     */

    public function render(): View
    {
        return view('livewire.animal-card', [
            'animals'  => $this->animals,
        ]);
    }
}
