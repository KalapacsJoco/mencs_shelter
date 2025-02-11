<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ListAnimals;
use App\Livewire\ShowAnimal;
use App\Livewire\ShowShelter;
use App\Models\Animal;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $animals = Animal::with(['images'])->limit(10)->get();
    return view('dashboard', compact('animals'));
});

Route::get('/shelters/{shelter}', ShowShelter::class)->name('shelters.show');
Route::get('/animals/{animal}', ShowAnimal::class)->name('animal.show');
Route::get('/animals', ListAnimals::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
