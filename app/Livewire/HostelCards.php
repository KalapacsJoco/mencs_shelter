<?php

namespace App\Livewire;

use App\Models\Hostel;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

/**
 * This class is used to render the hostel card component to the dashboard.
 */

class HostelCards extends Component
{

    /**
     * The hostels collection.
     */

    public Collection $hostels;

    /**
     * This method is used to mount the component.
     */

    public function mount(): void
    {
        $this->hostels = Hostel::with('images')->get();
    }

    /**
     * This function redirects to the list of hostels.
     */

    public function listHostels()
    {
        return redirect()->route('hostels.list');
    }

    /**
     * This method is used to render the cards on the dashboard.
     */

    public function render(): View
    {
        return view('livewire.hostel-cards');
    }
}
