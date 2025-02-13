<div class="mt-24 md:mt-48 flex items-center justify-center">
    <article class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 md:w-2/3">
        @foreach ($vets as $vet )
            <x-vet-hostel-card :vet="$vet" />
        @endforeach
    </article>
</div>