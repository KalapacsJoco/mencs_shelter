<?php

namespace App\Http\Controllers;

use App\Models\Shelter;

class ShelterController extends Controller
{
    /**
     * This function redirect to the actual shelter`s site and shows it
     */
    public function show(Shelter $shelter)
    {
        return view('shelters.show', compact('shelter'));
    }
}
