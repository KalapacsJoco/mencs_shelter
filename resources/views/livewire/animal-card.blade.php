<x-scrollable-container>
    <h2 class="font-bold text-2xl mt-5">Animals</h2>
    <livewire:AnimalFilter/>
    <div x-ref="scrollContainer" x-on:scroll="scrollPos = $event.target.scrollLeft"
         class="overflow-x-auto scroll-smooth hide-scrollbar">
        <div class="grid grid-rows-2 grid-flow-col auto-cols-[250px] gap-4">
            @foreach ($animals as $animal)
                <x-animal-card :animal="$animal" 
                    wire:key="animal-{{ $animal->id }}"
                    wire:click="redirectToAnimal({{ $animal->id }})" />
            @endforeach

            @if (count($animals) < $totalAnimals)
                <div class="row-span-2 flex items-center justify-end pr-4">
                    <button wire:click="loadMore" class="primary-button-default hover:primary-button-hover">
                        Load More
                    </button>
                </div>
            @endif
        </div>
    </div>
</x-scrollable-container>