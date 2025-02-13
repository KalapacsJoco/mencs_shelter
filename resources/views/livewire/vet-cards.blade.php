<div class="w-full md:w-3/4">
    <x-scrollable-container>
        <h2 class="font-bold text-2xl mt-5 cursor-pointer" wire:click="listVets">
            Vets
        </h2>
        <div class="flex gap-4 overflow-x-auto md:grid md:grid-cols-2 md:grid-rows-2">
            @foreach ($vets as $vet)
                <div class="flex-shrink-0 w-full md:w-auto">
                    <x-vet-hostel-card :entity="$vet" />
                </div>
            @endforeach
        </div>
    </x-scrollable-container>
</div>