<x-scrollable-container>
    <h2 class="font-bold text-2xl mt-5">Animals</h2>
    <div class="relative flex  align-center">
        <select name="species" id="species" 
        wire:model.live="selectedSpecies">
            <option value="">Select a species</option>
            @foreach ($species as $name)
                <option value="{{ lcfirst($name) }}">{{ $name }}</option>
            @endforeach
        </select>
        <x-detailed-search/>
    </div>

    <div x-ref="scrollContainer" x-on:scroll="scrollPos = $event.target.scrollLeft"
        class="grid md:grid-rows-2 grid-flow-col gap-4 overflow-x-auto scroll-smooth hide-scrollbar">
        @foreach ($animals as $animal)
        <section 
        class="relative flex flex-col items-center justify-center  rounded-xl pb-10 w-60 h-60"
        wire:key="animal-{{ $animal->id }}" 
        wire:click='goToAnimal({{ $animal->id }})'>
            <img src="{{ asset('storage/' . $animal->images->first()?->path) }}" alt="animal image"
                class="w-60 h-60 rounded-2xl">
            <article class="absolute bottom-2 bg-background-noopacity w-4/5 rounded-2xl p-2">
                <div class="flex justify-between">
                    <h3>{{ $animal->name }}</h3>
                    <span class="{{ $animal->sex === 'male' ? 'text-blue-500' : 'text-pink-500' }}">
                        @if ($animal->sex === "male")
                            <x-swg.male-swg />
                        @else
                            <x-swg.female-swg />
                        @endif
                    </span>
                </div>
                <p>{{$animal->species->name}}, {{$animal->age}} years</p>
            </article>
        </section>
        @endforeach

        @if (count($animals) < $totalAnimals) <div class="flex justify-center items-center p-4">
            <button wire:click="loadMore" class="primary-button-default hover:primary-button-hover">
                Load More
            </button>
    </div>
    @endif
    </div>
</x-scrollable-container>