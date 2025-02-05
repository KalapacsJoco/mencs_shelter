<nav class="fixed z-50">

    <!--Megoldani a navbart, mert igy nem jo -->
    <div x-data="{ open: false }">
        <div class="fixed top-0 left-0 w-full flex justify-between z-50">
            <span class="hidden md:flex justify-between items-center w-full px-6">
                <div>
                    <a href="/">
                        <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="w-[101px] h-[25px]">
                    </a>
                </div>
                <div class="flex items-center space-x-10 mr-10  w-auto">
                    <a href="">Adoption</a>
                    <a href="/login">Login</a>
                    <select class="rounded-xl bg-transparent hover:bg-btnsecondary-hover">
                        <option value="">Language</option>
                        <option value="en">English</option>
                        <option value="ro">Romana</option>
                        <option value="hu">Magyar</option>
                    </select>
                </div>
            </span>
            <button class="flex  items-center text-lg font-semibold p-2 rounded" x-on:click="open = !open">
                <div class="flex items-center space-x-2">
                    <span x-show="!open">
                        <x-swg.sandwitch-swg />
                    </span>
                    <span x-show="open" x-transition>Menu</span>
                </div>
                <span x-show="open" x-transition>
                </span>
            </button>
            <button class="md:hidden">
                <x-swg.user-swg />
            </button>
        </div>

        <div class=" fixed inset-0 md:right-0 md:left-auto transition-all duration-300 w-full"
            :class="open ? 'w-screen h-screen' : 'hidden'">
            <div x-show="open" x-transition
                class="flex items-center w-screen h-screen bg-background-noopacity fixed md:justify-end -z-10">
                <ul class="">
                    <li class="flex items-center  my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.paws-swg /> <span>Adoption</span>
                        </button>
                    </li>
                    <li class="flex items-center my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.exclamationmark-swg /><span>Lost animals</span>
                        </button>
                    </li>
                    <li class="flex items-center my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.house-swg /><span>Shelters</span>
                        </button>
                    </li>
                    <li class="flex items-center my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.hospital-swg /><span>Animal clinics</span>
                        </button>
                    </li>
                    <li class="flex items-center my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.dollar-swg /><span>Donations</span>
                        </button>
                    </li>
                    <li class="flex items-center my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.foundraisers-swg /><span>Fundraisers</span>
                        </button>
                    </li>
                    <li class="flex items-center my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.house-swg /><span>Pet Boarding & Grooming</span>
                        </button>
                    </li>
                    <li class="flex items-center my-2 md:justify-end mr-12 ">
                        <button x-on:click="window.location.href = '#'" class="flex items-center mx-2">
                            <x-swg.english-swg /><span>Change Language</span>
                        </button>
                    </li>
                </ul>
                <x-paws-image class="fixed right-0 scale-x-[-1] -rotate-30 md:scale-x-100 md:left-0 ml-8" />
            </div>
        </div>
    </div>
</nav>