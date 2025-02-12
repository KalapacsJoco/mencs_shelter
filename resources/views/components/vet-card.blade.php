@props(['vet'])
@php
$today = strtolower(\Carbon\Carbon::today()->format('l'));
$todaySchedules = $vet->schedules->where('day_of_week', $today);
@endphp

<article class="md:flex w-full my-2 border-2 rounded-2xl items-center">
    <img src="{{ asset('storage/' . $vet->images->first()?->path) }}" alt="Vet image" class="w-full rounded-2xl md:size-40 p-2">
    <section class="flex justify-center items-center flex-col w-full">
        <div>
            <p>{{ $vet->city }}</p>
            <h3>{{ $vet->name }}</h3>
            <h3>{{ $vet->shedule }}</h3>
            <p class="flex">
                <span>Today:</span>
                @if($todaySchedules->isNotEmpty())
                @foreach($todaySchedules as $schedule)
            <h3>{{ $schedule->start_time }} - {{ $schedule->end_time }}</h3>
            @endforeach
            @else
            <p>No schedule for today</p>
            @endif
            </p>
        </div>
    </section>
</article>