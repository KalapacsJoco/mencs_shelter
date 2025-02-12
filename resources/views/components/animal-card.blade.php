@props(['animal'])

<section class="relative flex flex-col items-center justify-center pb-10 w-full h-full aspect-square"
         wire:key="animal-{{ $animal->id }}"
         wire:click="redirectToAnimal({{ $animal->id }})">
    <img src="{{ asset('storage/' . $animal->images->first()?->path) }}" alt="animal image"
         class="w-full h-full rounded-2xl object-cover">
    <article class="absolute bottom-2 bg-background-noopacity w-4/5 rounded-2xl p-2">
        <div class="flex justify-between">
            <h3>{{ $animal->name }}</h3>
            <span>
                @if ($animal->sex === "male")
                    <x-swg.male-swg />
                @else
                    <x-swg.female-swg />
                @endif
            </span>
        </div>
        <p>{{ $animal->species->name }}, {{ $animal->age }} years</p>
    </article>
</section>