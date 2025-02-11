<div class="mt-48">
    <div class="w-4/5 mx-auto">
        <h1 class="text-2xl font-bold mb-4">Animals</h1>
        <div class=" mt-8">
            <livewire:AnimalFilter :species="$species" :colors="$colors" :vaccines="$vaccines" :cityes="$cityes" />
        </div>
        <section class="grid grid-cols-1 md:grid-cols-4 grid-rows-4 gap-4">
            @foreach ($animals as $animal)
            <x-animal-card :animal="$animal" />
            @endforeach
        </section>
        <div class="flex justify-center mt-4">
            {{ $animals->links() }}
        </div>
    </div>
</div>