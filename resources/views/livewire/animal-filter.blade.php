<div>
    <div class="md:flex justify-between align-center my-4 w-full">
        <x-select-field name="species" id="species" wire:model.live="selectedSpecies">
            <option value="">Select a species</option>
            @foreach ($species as $name)
            <option value="{{ lcfirst($name) }}">{{ $name }}</option>
            @endforeach
        </x-select-field>
        <div x-data="{ open: false, sexOptions: false, ageOptions: false, colorOptions: false, vaccineOptions: false, cityOptions: false }"
            x-on:click.outside="open = false">
            <button x-on:click="open = !open" class="primary-button-default flex">
                <span>Detailed search</span>
                <x-swg.filter-swg />
            </button>
            <section class="bg-background-noopacity" x-show="open == true">
                <div>
                    <div class="bg-white rounded-2xl m-1">
                        <div x-on:click="sexOptions = !sexOptions" class="flex justify-between items-center cursor-pointer">
                            <span>Sex</span>
                            <span>
                                <span x-show="!sexOptions">
                                    <x-swg.chevrondown-swg />
                                </span>
                                <span x-show="sexOptions">
                                    <x-swg.chevronup-swg />
                                </span>
                            </span>
                        </div>
                        <div x-show="sexOptions" class="mt-2">
                            <label for="male">Male</label>
                            <input name="sex" type="radio" value="male" wire:model="sex" @click.stop>
                            <label for="female">Female</label>
                            <input name="sex" type="radio" value="female" wire:model="sex" @click.stop>
                        </div>
                    </div>
    
                    <div class="bg-white rounded-2xl m-1">
                        <div x-on:click="ageOptions = !ageOptions" class="flex justify-between items-center cursor-pointer">
                            <span>Age</span>
                            <span>
                                <span x-show="!ageOptions">
                                    <x-swg.chevrondown-swg />
                                </span>
                                <span x-show="ageOptions">
                                    <x-swg.chevronup-swg />
                                </span>
                            </span>
                        </div>
                        <div x-show="ageOptions" class="mt-2">
                            <input name="age" type="radio" value="<1" wire:model="age" @click.stop>
                            <label for="age">Less than 1</label><br>
                            <input name="age" type="radio" value="1-5" wire:model="age" @click.stop>
                            <label for="age">1-5</label><br>
                            <input name="age" type="radio" value=">5" wire:model="age" @click.stop>
                            <label for="age">Greater than 5</label>
                        </div>
                    </div>
    
                    <div class="bg-white rounded-2xl m-1">
                        <div x-on:click="colorOptions = !colorOptions"
                            class="flex justify-between items-center cursor-pointer">
                            <span>Color</span>
                            <span>
                                <span x-show="!colorOptions">
                                    <x-swg.chevrondown-swg />
                                </span>
                                <span x-show="colorOptions">
                                    <x-swg.chevronup-swg />
                                </span>
                            </span>
                        </div>
                        <div x-show="colorOptions" class="mt-2 flex flex-col">
                            @foreach ($colors as $color)
                            <div class="flex items-center">
                                <input type="checkbox" name="color[]" value="{{ $color }}" wire:model="color" @click.stop>
                                <label for="color">{{ ucfirst($color) }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
    
                    <div class="bg-white rounded-2xl m-1">
                        <div x-on:click="vaccineOptions = !vaccineOptions"
                            class="flex justify-between items-center cursor-pointer">
                            <span>Vaccines</span>
                            <span>
                                <span x-show="!vaccineOptions">
                                    <x-swg.chevrondown-swg />
                                </span>
                                <span x-show="vaccineOptions">
                                    <x-swg.chevronup-swg />
                                </span>
                            </span>
                        </div>
                        <div x-show="vaccineOptions" class="mt-2 flex flex-col">
                            @foreach ($vaccines as $vaccine)
                            <div class="flex items-center">
                                <input type="checkbox" name="vaccine[]" value="{{ $vaccine }}" wire:model="vaccine"
                                    @click.stop>
                                <label for="vaccine">{{ $vaccine }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
    
                    @if (!str_contains(request()->url(), 'shelter'))
                    <div class="bg-white rounded-2xl m-1">
                        <div x-on:click="cityOptions = !cityOptions"
                            class="flex justify-between items-center cursor-pointer">
                            <span>City</span>
                            <span>
                                <span x-show="!cityOptions">
                                    <x-swg.chevrondown-swg />
                                </span>
                                <span x-show="cityOptions">
                                    <x-swg.chevronup-swg />
                                </span>
                            </span>
                        </div>
                        <div x-show="cityOptions" class="mt-2 flex flex-col">
                            @foreach ($cityes as $city)
                            <div class="flex items-center">
                                <input type="checkbox" name="city[]" value="{{ $city }}" wire:model="city" @click.stop>
                                <label for="city">{{ $city }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="flex justify-end gap-4">
                    <x-secondary-button wire:click="filterAnimals">Search</x-secondary-button>
                    <x-danger-button wire:click="deleteFilters">Delete filters</x-danger-button>
                </div>
            </section>
        </div>
    </div>
</div>
