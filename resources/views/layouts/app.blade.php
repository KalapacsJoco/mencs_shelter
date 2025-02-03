<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <nav>
        <a href="/"> <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo">
        </a>
        <div x-data="{ 
            activeIndex: 0, 
            links: [
                { text: 'Adopt now', url: '#' },
                { text: 'Find Vets', url: '#' },
                { text: 'Hostels', url: '#' }
            ] 
        }" x-init="setInterval(() => activeIndex = (activeIndex + 1) % links.length, 3000)"
            class="flex flex-col items-center space-y-4">

            <ul class="flex space-x-4 text-lg font-semibold">
                <template x-for="(link, index) in links" :key="index">
                    <li x-show="activeIndex === index">
                        <a :href="" class="hover:text-primary text-gray-700" x-text="link.text"></a>
                    </li>
                </template>
            </ul>

            <div class="flex space-x-2">
                <template x-for="(link, index) in links" :key="index">
                    <div :class="activeIndex === index ? 'bg-black' : 'bg-gray-400'"
                        class="w-3 h-3 rounded-full transition-all duration-300"></div>
                </template>
            </div>

        </div>

    </nav>
    <main>
        {{ $slot }}
    </main>
    <footer>

    </footer>
</body>

</html>