@props(['entity'])

@php
    use Illuminate\Support\Str;
    $today = strtolower(\Carbon\Carbon::today()->format('l'));
    $todaySchedules = collect();
    if ($entity instanceof \App\Models\Vet) {
        $todaySchedules = $entity->schedules->filter(function ($schedule) use ($today) {
    return strtolower($schedule->day_of_week) === $today;
    });
    } 
    else {
        $decoded = is_array($entity->schedules) ? $entity->schedules : json_decode($entity->schedules, true);
        $todaySchedules = collect($decoded)->filter(function ($schedule) use ($today) {
    return isset($schedule['day_of_week']) && strtolower($schedule['day_of_week']) === $today;
    });
    }
@endphp

<article 
    class="flex w-full md:flex-col my-2 border-2 rounded-2xl items-center" 
    x-data="{ showModal: false }"
    x-on:click="showModal=true">
    <div class="flex justify-between w-full">
        <img src="{{ asset('storage/' . $entity->images->first()?->path) }}" alt="Entity image"
            class="rounded-2xl size-40 md:size-40 p-2">
        <section class="flex justify-center items-center flex-col w-full">
            <div>
                <p>{{ $entity->city }}</p>
                <h2>{{ $entity->name }}</h2>
                @if ($entity instanceof \App\Models\Vet)

                <h3>{{ $entity->shedule ?? '' }}</h3>
                <p class="flex">
                    <span>Today: </span>
                    @if($todaySchedules->isNotEmpty())
                        @foreach($todaySchedules as $schedule)
                            <span class="ml-2">
                                {{ substr($schedule['start_time'] ?? $schedule->start_time, 0, -3) }} -
                                {{ substr($schedule['end_time'] ?? $schedule->end_time, 0, -3) }}
                            </span>
                        @endforeach
                    @else
                        <span class="ml-2">No schedule for today</span>
                    @endif
                </p>
                @else
                    <p class="text-ellipsis">{{$entity->description}}</p>
                @endif
            </div>
        </section>
        <x-vet-hostel-modal :entity="$entity" />
    </div>
    @if ($entity instanceof \App\Models\Hostel)
        <div class="hidden md:flex justify-around w-full">
            @foreach ($entity->tags as $tag )
                <span class="m-1 border-2 rounded-2xl">{{$tag->name}}</span>
            @endforeach
        </div>
    @endif
</article>