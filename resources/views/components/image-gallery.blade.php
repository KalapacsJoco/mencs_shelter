@props(['images'])

<div x-data="{ selectedImage: '{{ asset('storage/' . ($images[0]->path ?? 'default.jpg')) }}' }"
    {{ $attributes->merge(['class' => '']) }}>
   
    
    <div class="w-auto md:h-[452px]">
        <img :src="selectedImage" 
             class="w-full md:w-[768px] h-full object-cover rounded-lg"
             alt="Selected Image">
    </div>

    <div class="hidden md:flex flex-col gap-2 overflow-y-auto h-[452px]">
        @foreach($images as $image)
            <img src="{{ asset('storage/' . $image->path) }}" 
                 x-on:click="selectedImage = '{{ asset('storage/' . $image->path) }}'" 
                 class="size-40 object-cover rounded-lg cursor-pointer border-2 hover:border-background transition"
                 alt="Shelter Image">
        @endforeach
    </div>
</div>
