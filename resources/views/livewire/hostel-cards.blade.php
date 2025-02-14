<div class="w-full md:w-3/4">
    <x-scrollable-container>
        <h2 class="font-bold text-2xl mt-5 cursor-pointer" wire:click="listHostels">
            Hostels
        </h2>
        <div class="flex gap-4 overflow-x-auto md:grid md:grid-cols-2 md:grid-rows-2">
            @foreach ($hostels as $hostel)
            <div class="flex-shrink-0 w-full md:w-auto">
                <x-vet-hostel-card :entity="$hostel" />
            </div>
            @endforeach
        </div>
    </x-scrollable-container>
</div>