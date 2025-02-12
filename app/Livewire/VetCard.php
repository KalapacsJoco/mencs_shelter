<?php

namespace App\Livewire;

use App\Models\Vet;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

/**
 * This class is used to render the vet card component.
 */

class VetCard extends Component
{

    /**
     * The vets collection.
     */

    public Collection $vets;

    /**
     * This method is used to mount the component.
     */

    public function mount(): void
    {
        $this->vets = Vet::with('images')->get();
    }

    /**
     * This method is used to render the cards on the dashboard.
     */

    public function render(): View
    {
        return view('livewire.vet-card');
    }
}
