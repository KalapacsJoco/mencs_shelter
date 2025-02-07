<x-app-layout>
    <header class="flex flex-col items-center justify-center text-center p-6 md:hidden mt-24">
        <h2 class="text-2xl font-bold text-gray-900">
            Hello, animal lover,
            <h4 class="text-lg text-gray-600 font-medium">We're glad to have you here!</h4>
        </h2>

        <section class="mt-4 bg-background-noopacity text-lg rounded-3xl p-4  w-full ">
            <h3 class="text-md">
                Adopt a pet, don't buy one, and join our cause!
            </h3>
            <a href="#" class="">
                <x-secondary-button>Adoption</x-secondary-button>
            </a>
        </section>
        <x-paws-image />
    </header>

    <div class="hidden md:flex flex-col items-center space-y-4 bg-cover bg-center bg-no-repeat min-h-screen relative transition-all duration-1000 ease-in-out"
        x-data="headerComponent" x-init="setInterval(() => changeBackground(), 5000)"
        :style="'background-image: url(' + backgrounds[activeIndex] + ');'">

        <div class="absolute inset-0 bg-background bg-opacity-60"></div>

        <div class="absolute bottom-48 left-48 max-w-lg text-left text-black">
            <h1 class="text-4xl font-bold" x-text="texts[activeIndex].title"></h1>
            <p class="mt-2 text-lg opacity-80" x-text="texts[activeIndex].subtitle"></p>
            <a href="">
                <x-primary-button x-text="texts[activeIndex].button"></x-primary-button>
            </a>
        </div>

        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3 ">
            <template x-for="(link, index) in links" :key="index">
                <div :class="activeIndex === index ? 'bg-black' : 'bg-gray-400'"
                    class="w-3 h-3 rounded-full transition-all duration-500"></div>
            </template>
        </div>
    </div>
    <div class="flex flex-col items-center">
        <livewire:Animal />
        {{-- <livewire:animal :shelterId="$shelter->id" /> --}}
        <livewire:Shelter />
    </div>
    <script>
        function headerComponent() {
            return {
                activeIndex: 0,
                texts: [
                    { title: 'Be the loving owner of a pet in need', subtitle: 'Adpot a bundle of love today.', button: 'Adopt now' },
                    { title: 'Care for your Pet`s health', subtitle: 'Find the perfect professionals for your pet`s medical need.', button: 'Find Vets' },
                    { title: 'Pedicure or massage?', subtitle: 'Make sure your pet always looks its best.', button: 'Hostels' },

                ],
                links: [
                    { text: 'Adopt now', url: '#' },
                    { text: 'Find Vets', url: '#' },
                    { text: 'Hostels', url: '#' }
                ],
                backgrounds: [
                    '/storage/images/headers/first.avif',  
                    '/storage/images/headers/vet.jpg', 
                    '/storage/images/headers/hostel.webp'   
                ],
                changeBackground() {
                    this.$el.style.transition = 'background-image 1s ease-in-out'; 
                    this.activeIndex = (this.activeIndex + 1) % this.backgrounds.length;
                    this.$el.style.backgroundImage = `url(${this.backgrounds[this.activeIndex]})`;
                }
            }
        }

    </script>
</x-app-layout>