<div>
    <x-app-layout>
        <article class="w-4/5 mt-48 mx-auto">
            <h1 class="h1-style">{{$shelter->name}}</h1>
            <h3>{{$shelter->city}}</h3>
            <section class="md:flex gap-4 h-1/2">
                <x-image-gallery :images="$shelter->images" class="w-full flex flex-col md:flex-row gap-2" />
                    <div class="w-full md:w-1/2 h-[500px]  flex flex-col">
                        <section class="bg-background shadow-sm rounded-xl">
                        <h2 class="h1-style mx-2 border-b-2">{{ $shelter->name }}</h2>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.location-swg />
                            </span>
                            <span>Location: {{ $shelter->city }}, {{ $shelter->street }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.paws-swg />
                            </span>
                            <p>{{ $shelter->animals->count() }} pet awaits their owner</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.heart-swg />
                            </span>
                            <p>Number of likes: {{ $shelter->likes }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.phone-swg />
                            </span>
                            <p>Phone: {{ $shelter->phone_number }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.mail-swg />
                            </span>
                            <p>Email: {{ $shelter->email }}</p>
                        </div>
                    </section>
                    <article class="border rounded-xl h-full overflow-y-auto mb-12 mt-4">
                        {{ $shelter->description }}
                    </article>
                </div>
            </section>
        </article>
        <section class="grid grid-cols-1 md:grid-cols-4 gap-8 w-4/5 mx-auto">
            @foreach ($animals as $animal)
            <div wire:click="redirectToAnimal({{ $animal->id }})">
                <x-animal-card :animal="$animal" />
            </div>
            @endforeach
        </section>
        <div class="flex justify-center mt-8">
            {{ $animals->links() }}
        </div>
    </x-app-layout>
</div>