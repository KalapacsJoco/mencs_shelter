@props(['vet'])
@php
$today = strtolower(\Carbon\Carbon::today()->format('l'));
$todaySchedules = $vet->schedules->where('day_of_week', $today);
@endphp

<article class="flex w-full m-auto my-4">
    <img src="{{ asset('storage/' . $vet->images->first()?->path) }}" alt="Vet image" class="rounded-2xl size-40">
    <section>
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
    </section>
</article>