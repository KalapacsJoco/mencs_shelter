<x-app-layout>
        <article class="w-auto mt-48">
            <h1 class="h1-style">{{$shelter->name}}</h1>
            <h3>{{$shelter->city}}</h3>
            <section class="md:flex gap-8 h-[60vh]">
                <livewire:image-gallery :images="$shelter->images" class="" />
                <aside class="w-full md:w-1/3">
                    <section class="bg-background shadow-sm rounded-xl">
                        <h2 class="h1-style mx-2 border-b-2">{{$shelter->name}}</h2>
                        <div class="flex items-center space-x-2">
                            <span>
                                <x-swg.location-swg />
                            </span>
                            <address>Location: {{$shelter->city}}, {{$shelter->street}}</address>
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
                    <article class="border my-8 rounded-xl ">
                        {{$shelter->description}}
                    </article>
                </aside>
            </section>
        </article>
</x-app-layout>