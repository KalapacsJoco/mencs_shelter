<div>
    <x-app-layout>
        <article class="w-4/5 mt-48 mx-auto">
            <h1 class="h1-style">{{$shelter->name}}</h1>
            <h3>{{$shelter->city}}</h3>
            <section class="md:flex gap-8 h-1/2">
                <x-image-gallery :images="$shelter->images" class="w-full flex flex-col md:flex-row gap-2" />
                <div class="w-full md:w-1/3">
                    <section class="bg-background shadow-sm rounded-xl">
                        <h2 class="h1-style mx-2 border-b-2">{{$shelter->name}}</h2>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.location-swg />
                            </span>
                            <span>Location: {{$shelter->city}}, {{$shelter->street}}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.paws-swg />
                            </span>
                            <p>{{$shelter->animals->count()}} pet awaits their owner</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.heart-swg />
                            </span>
                            <p>Number of likes: {{$shelter->likes}}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.phone-swg />
                            </span>
                            <p>Phone: {{$shelter->phone_number}}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.mail-swg />
                            </span>
                            <p>Email: {{$shelter->email}}</p>
                        </div>
                    </section>
                    <article class="border my-8 rounded-xl text-ellipsis ">
                        {{$shelter->description}}
                    </article>
                </div>
            </section>
        </article>
        <section class="grid grid-cols-1 md:grid-cols-4 grid-rows-4 w-4/5 mx-auto gap-8">
            @foreach ($animals as $animal)
            <div class=""
            wire:click="redirectToAnimal({{$animal->id}})">
                <img src="{{ asset('storage/' . $animal->images->first()?->path) }}" alt="animal image" class="w-full h-full rounded-2xl" />
                <article class=" relative bottom-16 bg-background-noopacity rounded-2xl p-2 w-4/5 mx-auto ">
                    <div class=" flex justify-between">
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
            </div>
            @endforeach
        </section>
        <div class="flex justify-center mt-8">
            {{ $animals->links() }}
            </div>
    </x-app-layout>
</div>