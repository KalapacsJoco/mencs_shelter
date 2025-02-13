<div x-show="showModal == true" class="inset-0 fixed z-50 flex items-center justify-center bg-gray-500 bg-opacity-50">
    <article class="bg-background-noopacity w-3/4 md:w-1/4 flex flex-col items-center p-4"
        x-on:click.outside="showModal=false">
        <div class="flex justify-between w-full">
            <h2>{{$vet->name}}</h2>
            <span x-on:click.stop="showModal=false" style="cursor:pointer">X</span>
        </div>
        <img src="{{ asset('storage/' . $vet->images->first()?->path) }}" alt="Vet image"
            class="size-60 p-4 rounded-2xl">
        <div>
            @foreach ($vet->services as $service)
            <li class="w-full">{{$service->name}}</li>
            @endforeach
        </div>
        <h3 class="w-full text-center my-2 font-bold">Schedule:</h3>
        <div>
            @foreach ($vet->schedules as $schedule)
            <div class="flex justify-between">
                <li>{{ ucfirst(substr($schedule->day_of_week, 0, 3)) }}: <span
                        class="ml-4">{{substr($schedule->start_time, 0, -3)}} - {{substr($schedule->end_time, 0,
                        -3)}}</span>
                </li>
            </div>
            @endforeach
        </div>
        <h3 class="w-full text-center my-2 font-bold">Contact</h3>
        <div class="flex items-center justify-center">
            <x-swg.phone-swg />
            <p>{{$vet->phone_number}}</p>
        </div>
        <div class="flex items-center justify-center">
            <x-swg.mail-swg />
            <p>{{$vet->email}}</p>
        </div>
    </article>

</div>