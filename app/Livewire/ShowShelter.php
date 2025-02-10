<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shelter;
use Livewire\WithPagination;

class ShowShelter extends Component
{

    use WithPagination;

    public Shelter $shelter;

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
     * This function renders the shelter instance to the show page
     */

    public function render()
    {
        return view('livewire.show-shelter',[
            'animals' => $this->shelter->animals()->paginate(6),
        ]);
    }
}
