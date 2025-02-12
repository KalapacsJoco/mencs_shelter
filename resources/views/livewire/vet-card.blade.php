<div class="w-full md:w-3/4">
<x-scrollable-container >
    <h2 class="font-bold text-2xl mt-5">Vets</h2>
    <div class="grid md:grid-cols-2 grid-rows-1 gap-4 overflow-x-auto">
    @foreach ($vets as $vet)
    <x-vet-card :vet="$vet" />
    @endforeach
</div>
</x-scrollable-container>
</div>
