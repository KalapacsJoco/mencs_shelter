<?php

namespace App\Livewire;

use App\Mail\PetAdopted;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
     * This function will rewrite the animal`s status to adopted if the user is logged in and the animal is available.
     * Also sends a confirmation email (using a queue, without supervisor...yet) to the user.
     */

    public function adoptAnimal(): void
    {
        $user = Auth::user();
        $owner = User::find(Auth::id($user->id));

        if (Auth::check() && $this->animal->status === 'available') {
            $this->animal->status = 'adopted';
            $this->animal->save();
            Mail::to($owner->email)->queue(new PetAdopted($owner, $this->animal));
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
