<div class="w-auto flex flex-col md:flex-row gap-2">
    <div class="w-auto md:h-[452px]">
        <img src="{{ asset($selectedImage) }}" 
             class="w-full md:w-[768px] object-cover rounded-lg" 
             alt="Selected Image">
    </div>

    <div class="hidden md:flex flex-col gap-2 overflow-y-auto h-[452px]">
        @foreach($images as $image)
            <img src="{{ asset($image->path) }}" 
                 wire:click="selectImage('{{ $image->path }}')" 
                 class="size-40 object-cover rounded-lg cursor-pointer border-2 transition"
                 alt="Shelter Image">
        @endforeach
    </div>
</div>
