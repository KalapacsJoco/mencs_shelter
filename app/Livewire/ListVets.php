<?php

namespace App\Livewire;

use App\Models\Vet;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * This class is used to list all the vets to their own page.
 */

class ListVets extends Component
{
    /**
     * This trait allows to paginate the data.
     */

    use WithPagination;

    /**
     * This function is used to render the vets.
     */

    public function render(): View
    {
        $query = Vet::with(['images']);

        return view('livewire.list-vets',[
            'vets' => $query->paginate(8)
        ]);
    }
}
