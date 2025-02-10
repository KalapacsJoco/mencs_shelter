<div>

    <div class="mx-4 mt-32">
        <h1 class="h1-style">{{$animal->name}}</h1>
        <h2>{{$animal->shelter->city}}</h2>
        @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <article class=" w-full mx-auto md:flex">

        <section class="w-1/2 mx-4">
            <x-image-gallery :images="$animal->images" class="flex flex-col" />

            {{-- <img src="{{ asset('storage/' . $animal->images->first()?->path) }}" alt="animal image"
                class="w-full h-full rounded-2xl" /> --}}
        </section>
        <section class="w-1/2">
            <article class=" bg-background shadow-sm rounded-xl mx-4">
                <h2 class="h2-style">Details about me</h2>
                <div class="my-1">
                    <p class="h2-style">Name</p>
                    <p>{{$animal->name}}</p>
                </div>
                <div class="my-1">
                    <p class="h2-style">Species</p>
                    <p>{{$animal->breed->name}}</p>
                </div>
                <div class="my-1">
                    <p class="h2-style">Age</p>
                    <p>{{$animal->age}} years</p>
                </div>
                <div class="my-1">
                    <p class="h2-style">Colors</p>
                    <p>{{$animal->color}}</p>
                </div>
                <div class="my-1">
                    <p class="h2-style">Status</p>
                    <p>{{$animal->status}}</p>
                </div>
                <div class="my-1">
                    <p class="h2-style">Vaccines</p>
                    {{-- @foreach ($animal->vaccines as $vaccine)
                    <p>{{ $vaccine->name }}</p>
                    @endforeach --}}
                </div>
            </article>
            <article class="mx-4 shadow-md rounded-lg">
                <h3 class="font-bold">Message from my caretakers</h3>
                <p>{{$animal->message}}</p>
            </article>
            <a href="/shelters/{{$animal->shelter_id}}" class="flex mx-4 rounded-lg shadow-md my-2">
                <img src="{{ asset('storage/' . $animal->shelter->images->first()?->path) }}" alt="animal image"
                    class="size-48" />
                <div>
                    <h3 class="font-bold">{{$animal->shelter->name}}</h3>
                    <h4>{{$animal->shelter->city}}</h4>
                </div>
            </a>
            <div class="my-2">
                @auth
                @if ($animal->status === 'available')
                <button wire:click="adoptAnimal"
                    class="primary-button-default flex items-center justify-center mx-4 my-2 rounded-lg shadow-md justify-self-end">
                    <x-swg.paws-swg />
                    <span>Adopt</span>
                </button>
                @else
                <button disabled
                    class="primary-button-default flex items-center justify-center mx-4 my-2 rounded-lg shadow-md justify-self-end">
                    <span>Adopted</span>
                </button>
                @endif
                @else
                <a href="{{ route('login') }}"
                    class="primary-button-default flex items-center justify-center mx-4 my-2 rounded-lg shadow-md">
                    <x-swg.paws-swg />
                    <span>Adopt</span>
                </a>
                @endauth
            </div>
        </section>
    </article>
</div>