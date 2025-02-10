<?php

namespace App\Livewire;

use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowAnimal extends Component
{
    public Animal $animal;

    /**
     * This function will rewrite the animal`s status to adopted if the user is logged in and the animal is available
     */

    public function adoptAnimal()
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

    public function render()
    {
        return view('livewire.show-animal');
    }
}
