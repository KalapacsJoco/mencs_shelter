<x-scrollable-container>
    <h2 class="font-bold text-2xl mt-5">Shelters</h2>
    <div x-ref="scrollContainer" x-on:scroll="scrollPos = $event.target.scrollLeft"
        class="flex space-x-4 overflow-x-auto scroll-smooth hide-scrollbar">
        @foreach ($shelters as $shelter)
                <section 
                        class="flex flex-col items-center justify-center drop-shadow-md border p-5 m-2 rounded-xl"
                        wire:key="shelter-{{ $shelter->id }}" 
                        wire:click='goToShelter({{ $shelter->id }})'>
                    <img src="{{ asset('storage/' . $shelter->images->first()->path) }}" alt="Shelter image"
                        class="w-[256px] h-[173px] rounded-[12px] p-2">
                    <h3 class="w-[256px] font-bold text-2xl leading-[26.76px] p-2">{{ $shelter->name }}</h3>
                    <article>
                        {{ \Illuminate\Support\Str::limit($shelter->description, 100, '...') }}
                    </article>
            </section>
        @endforeach
    </div>
</x-scrollable-container>