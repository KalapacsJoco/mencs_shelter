<?php

namespace App\Livewire;

use App\Models\Hostel;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * This class is used to list all the hostels to their own page.
 */

class ListHostels extends Component
{
    /**
     * This trait allows to paginate the data.
     */

    use WithPagination;

    /**
     * This function is used to render the hostels.
     */

    public function render(): View
    {
        $query = Hostel::with(['images']);

        return view('livewire.list-hostels', [
            'hostels' => $query->paginate(8)
        ]);
    }
}
