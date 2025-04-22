<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Component;

class LanguageSelector extends Component
{

    /**
     * The language state
     *
     * @var string
     */
    #[Session]
    public $selectedLanguage;

    /**
     * Change the language
     *
     * @param int $selected
     * @return mixed
     */
    #[On('language-changed')]
    public function changeLanguage(string $selectedLanguage): mixed
    {
        
        $this->selectedLanguage = $selectedLanguage;
        // dd($this->selectedLanguage);

        app()->setLocale($this->selectedLanguage);
        session()->put('locale', $this->selectedLanguage);
        session()->save();
        $this->selectedLanguage = session()->get('locale', app()->getLocale());
        // dd(app()->getLocale());
        // dd(session('locale'));


        // Reload the page to reflect the language change
        return redirect()->to(request()->header('Referer'));
    }

    /**
     * Placeholder before the component is rendered
     *
     * @return string
     */
    public function placeholder(): string
    {
        return <<<HTML
            <x-skeleton.language-selector />
        HTML;
    }

    /**
     * Render the component
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('livewire.language-selector');
    }
}