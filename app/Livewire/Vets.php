<?php

namespace App\Livewire;

use App\Models\Vet;
use Livewire\Component;

class Vets extends Component
{

    public $vets;

    public function mount(): void
    {
        $this->vets = Vet::with('images')->get();
    }
    
    public function render()
    {
        return view('livewire.vets');
    }
}
