<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * This class is responsible for the image showing logic in the shelter`s own page
 */

class ImageGallery extends Component
{
    public $images = [];
    public $selectedImage;

    /**
     * This function loads the shelter instace`s images
     */

     public function mount($images)
     {
         $this->images = $images;
         $this->selectedImage = $images[0]->path ?? null;
     }

    /**
     * This function will activvates the selected picture and shows it as the main picture in the gallery 
     */

    public function selectImage($image)
    {
        $this->selectedImage = $image;
        // dd($this->selectedImage);
    }

    /**
     * This function renders the pictures
     */

    public function render()
    {
        return view('livewire.image-gallery');
    }
}
