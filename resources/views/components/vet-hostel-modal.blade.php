@props(['entity'])
<div x-show="showModal == true" class="inset-0 fixed z-50 flex items-center justify-center bg-gray-500 bg-opacity-50">
    <article class="bg-background-noopacity w-3/4 md:w-1/4 flex flex-col items-center p-4"
        x-on:click.outside="showModal=false">
        <div class="flex justify-between w-full">
            <h2>{{ $entity->name }}</h2>
            <span x-on:click.stop="showModal=false" style="cursor:pointer">X</span>
        </div>
        <img src="{{ asset('storage/' . $entity->images->first()?->path) }}" alt="Image"
            class="size-60 p-4 rounded-2xl">

        @if($entity instanceof \App\Models\Vet)
            <div>
                @foreach ($entity->services as $service)
                    <li class="w-full">{{ $service->name }}</li>
                @endforeach
            </div>
        @else
            <div>
                @foreach ($entity->tags as $tag )
                    <li class="w-full">{{$tag->name}}</li>
                @endforeach
            </div>
        @endif
        <h3 class="w-full text-center my-2 font-bold">Weekly Schedule:</h3>
        <div>
            @if($entity instanceof \App\Models\Vet)
                @if($entity->schedules->isNotEmpty())
                    @php
                        $weeklySchedules = $entity->schedules;
                    @endphp
                    @foreach ($weeklySchedules as $schedule)
                        <div class="flex justify-between">
                            <span>
                                {{ ucfirst(substr($schedule->day_of_week, 0, 3)) }}:
                            </span>
                            <span class="ml-4">
                                {{ substr($schedule->start_time, 0, -3) }} - {{ substr($schedule->end_time, 0, -3) }}
                            </span>
                        </div>
                    @endforeach
                @else
                    <p>No schedules available</p>
                @endif
            @else
                @php
                    $decodedSchedules = is_array($entity->schedule)
                    ? $entity->schedule
                    : json_decode($entity->schedule, true);
                    $weeklySchedules = collect($decodedSchedules ?? []);
                @endphp
                @if($weeklySchedules->isNotEmpty())
                    <ul>
                        @foreach ($weeklySchedules as $schedule)
                            <div class="flex justify-between">
                               <span>
                                    {{ ucfirst($schedule['day_of_week']) }}:
                                </span>
                                <span class="ml-4">
                                    {{ $schedule['start_time'] }} - {{ $schedule['end_time'] }}
                                </span>                                
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>No schedules available</p>
                @endif
            @endif
        </div>
        <h3 class="w-full text-center my-2 font-bold">Contact</h3>
        <div class="flex items-center justify-center">
            <x-swg.phone-swg />
            <p>{{ $entity->phone_number }}</p>
        </div>
        <div class="flex items-center justify-center">
            <x-swg.mail-swg />
            <p>{{ $entity->email }}</p>
        </div>
    </article>
</div>