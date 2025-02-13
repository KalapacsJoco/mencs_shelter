@props(['vet'])
@php
$today = strtolower(\Carbon\Carbon::today()->format('l'));
$todaySchedules = $vet->schedules->where('day_of_week', $today);
@endphp

<article class=" flex w-full md:flex my-2 border-2 rounded-2xl items-center" x-data="{ showModal: false }"
    x-on:click="showModal=true">
    <img src="{{ asset('storage/' . $vet->images->first()?->path) }}" alt="Vet image"
        class="rounded-2xl size-40 md:size-40 p-2">
    <section class="flex justify-center items-center flex-col w-full">
        <div>
            <p>{{ $vet->city }}</p>
            <h2>{{ $vet->name }}</h2>
            <h3>{{ $vet->shedule }}</h3>
            <p class="flex">
                <span>Today:</span>
                @if($todaySchedules->isNotEmpty())
                @foreach($todaySchedules as $schedule)
            <h3>{{ substr($schedule->start_time, 0, -3) }} - {{ substr($schedule->end_time, 0, -3) }}</h3>
            @endforeach
            @else
            <p>No schedule for today</p>
            @endif
            </p>
        </div>
    </section>
    <x-vet-hostel-modal :vet="$vet" />
</article>