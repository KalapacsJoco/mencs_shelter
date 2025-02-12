<?php

namespace App\Livewire;

use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

/**
 * This class is responsible for rendering the animal instance to the show page.
 */

class ShowAnimal extends Component
{
    /**
     * This variable will store the animal instance.
     */

    public Animal $animal;

    /**
     * This function will rewrite the animal`s status to adopted if the user is logged in and the animal is available
     */

    public function adoptAnimal(): void
    {
        if (Auth::check() && $this->animal->status === 'available') {
            $this->animal->status = 'adopted';
            $this->animal->save();
            session()->flash('message', 'You have adopted this animal.');
        }
    }

    /**
     * This function renders the animal instance to the show page
     */

    public function render(): View
    {
        return view('livewire.show-animal');
    }
}
