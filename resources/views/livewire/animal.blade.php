<x-scrollable-container>
    <h2 class="font-bold text-2xl mt-5">Animals</h2>
    <div class="block md:flex  align-center my-4">
        <!-- Searchbar -->
        <select name="species" id="species" wire:model.live="selectedSpecies">
            <option value="">Select a species</option>
            @foreach ($species as $name)
            <option value="{{ lcfirst($name) }}">{{ $name }}</option>
            @endforeach
        </select>
        <div class="absolute right-0 z-50"
            x-data="{ open: false, sexOptions: false, ageOptions: false, colorOptions: false, vaccineOptions: false, cityOptions: false }">
            <button x-on:click="open = !open" class="primary-button-default flex">
                <span>Detailed search</span>
                <x-swg.filter-swg />
            </button>
            <section class="bg-background-noopacity" x-show="open == true">
                <div>
                    <div x-on:click="sexOptions = true">Sex
                        <div x-show="sexOptions == true">
                            <label for="male">Male</label>
                            <input name="sex" type="radio" value="male" wire:model="sex">
                            <label for="female">Female</label>
                            <input name="sex" type="radio" value="female" wire:model="sex">
                        </div>
                    </div>
                    <div x-on:click="ageOptions = true">Age
                        <div x-show="ageOptions == true">
                            <input name="age" type="radio" value="<1" wire:model="age">
                            <label for="age">Less than 1</label><br>
                            <input name="age" type="radio" value="1-5" wire:model="age">>
                            <label for="age">1-5</label><br>
                            <input name="age" type="radio" value=">5" wire:model="age">
                            <label for="age">Greater than 5</label>
                        </div>
                    </div>
                    <div x-on:click="colorOptions = true">Color
                        <div x-show="colorOptions == true" class="flex flex-col">
                            @foreach ($colors as $color)
                            <div class="flex items-center">
                                <label for="color">{{ $color }}</label>
                                <input type="checkbox" name="color[]" value="{{ $color }}" wire:model="color">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div x-on:click="vaccineOptions = true">Vaccines
                        <div x-show="vaccineOptions == true" class="flex flex-col">
                            @foreach ($vaccines as $vaccine)
                            <div class="flex items-center">
                                <label for="vaccine">{{ $vaccine }}</label>
                                <input type="checkbox" name="vaccine[]" value="{{ $vaccine }}" wire:model="vaccine">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @if (!str_contains(request()->url(), 'shelter'))
                    <div x-on:click="cityOptions =true">City</div>
                    <div x-show="cityOptions == true" class="flex flex-col">
                        @foreach ($cityes as $city)
                        <div class="flex items-center">
                            <label for="city">{{ $city }}</label>
                            <input type="checkbox" name="city[]" value="{{ $city }}" wire:model="city">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="flex justify-end">
                    <button wire:click="filterAnimals">Search</button>
                    <button>Delete filters</button>
                </div>
            </section>
        </div>
    </div>

    <div x-ref="scrollContainer" x-on:scroll="scrollPos = $event.target.scrollLeft"
        class="grid md:grid-rows-2 grid-flow-col gap-4 overflow-x-auto scroll-smooth hide-scrollbar">
        @foreach ($animals as $animal)
        <section class="relative flex flex-col items-center justify-center  rounded-xl pb-10 w-60 h-60"
            wire:key="animal-{{ $animal->id }}" wire:click='goToAnimal({{ $animal->id }})'>
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