<div class="w-4/5">
<x-scrollable-container >
    <h2>Vets</h2>
    <div class="grid grid-cols-2 grid-rows-1 overflow-x-auto">
    @foreach ($vets as $vet)
    <x-vet-card :vet="$vet" />
    @endforeach
</div>
</x-scrollable-container>
</div>
