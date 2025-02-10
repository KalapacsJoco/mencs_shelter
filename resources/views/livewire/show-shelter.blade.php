<div>
    <x-app-layout>
        <article class="w-screen mt-48 mx-auto">
            <h1 class="h1-style">{{$shelter->name}}</h1>
            <h3>{{$shelter->city}}</h3>
            <section class="md:flex gap-8 h-1/2">
                <x-image-gallery :images="$shelter->images" />
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

    </x-app-layout>
</div>