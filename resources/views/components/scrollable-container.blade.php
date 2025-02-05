<div x-data="{ scrollPos: 0, maxScroll: 0 }"
     x-init="$nextTick(() => maxScroll = $refs.scrollContainer.scrollWidth - $refs.scrollContainer.clientWidth)"
     class="relative w-2/3 mx-auto overflow-hidden">

    <button x-on:click="$refs.scrollContainer.scrollBy({ left: -500, behavior: 'smooth' })"
            x-show="scrollPos > 0"
            class="absolute -left-5 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg">
        <x-swg.chevronleft-swg />
    </button>

    <div x-ref="scrollContainer"
         x-on:scroll="scrollPos = $event.target.scrollLeft"
         class="flex space-x-4 overflow-x-auto scroll-smooth hide-scrollbar">
        {{ $slot }} 
    </div>

    <button x-on:click="$refs.scrollContainer.scrollBy({ left: 500, behavior: 'smooth' })"
            x-show="scrollPos < maxScroll"
            class="absolute -right-5 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg">
        <x-swg.chevronright-swg />
    </button>

</div>
