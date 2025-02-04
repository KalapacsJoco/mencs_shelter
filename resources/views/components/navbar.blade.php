<nav class="relative z-50">
    <div class="fixed top-0 left-0 md:right-0 md:left-auto transition-all duration-300 w-full" x-data="{ open: false }"
        :class="open ? 'w-screen h-screen p-4' : 'w-auto p-2'">
        <div class="hidden md:flex">
        </div>

        <div class="flex mx-5">

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
                        <option value="">English</option>
                        <option value="">Romana</option>
                        <option value="">Magyar</option>
                    </select>
                </div>
            </span>
            <button class="flex  items-center text-lg font-semibold p-2 rounded"
                x-on:click="open = !open">
                <div class="flex items-center space-x-2">
                    <span x-show="!open">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 27H30C30.825 27 31.5 26.325 31.5 25.5C31.5 24.675 30.825 24 30 24H6C5.175 24 4.5 24.675 4.5 25.5C4.5 26.325 5.175 27 6 27ZM6 19.5H30C30.825 19.5 31.5 18.825 31.5 18C31.5 17.175 30.825 16.5 30 16.5H6C5.175 16.5 4.5 17.175 4.5 18C4.5 18.825 5.175 19.5 6 19.5ZM4.5 10.5C4.5 11.325 5.175 12 6 12H30C30.825 12 31.5 11.325 31.5 10.5C31.5 9.675 30.825 9 30 9H6C5.175 9 4.5 9.675 4.5 10.5Z"
                                fill="#2B2A29" />
                        </svg>
                    </span>
                    <span x-show="open" x-transition>Menü</span>
                </div>
                <span x-show="open" x-transition>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L14 10L6 16" stroke="#2B2A29" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            </button>
        </div>

        <div x-show="open" x-transition>
            <img src="" alt="">
            <ul class="mt-4 space-y-4 bg-background-noopacity md:fixed w-screen h-screen ">
                <li class="flex items-center  md:justify-end mr-12">
                    <span>
                        <x-swg.paws-swg/>
                    </span>
                    <a href="#">Adoption</a>
                </li>
                <li class="flex items-center md:justify-end mr-12">
                    <span>
                        <x-swg.exclamationmark-swg/>
                    </span>
                    <a href="#">Lost animals</a>
                </li>
                <li class="flex items-center md:justify-end mr-12">
                    <span>
                        <x-swg.house-swg/>
                    </span>
                    <a href="#">Shelters</a>
                </li>
                <li class="flex items-center md:justify-end mr-12">
                    <span>
                        <x-swg.hospital-swg/>
                    </span>
                    <a href="#">Animal clinics</a>
                </li>
                <li class="flex items-center md:justify-end mr-12">
                    <span>
                        <x-swg.dollar-swg/>
                    </span>
                    <a href="#">Donations</a>
                </li>
                <li class="flex items-center md:justify-end mr-12">
                    <span>
                        <x-swg.foundraisers-swg/>
                    </span>
                    <a href="#">Fundraisers</a>
                </li>
                <li class="flex items-center md:justify-end mr-12">
                    <span>
                        <x-swg.house-swg/>
                    </span>
                    <a href="#"> Pet Boarding & Grooming</a>
                </li>
                <li class="flex items-center md:justify-end mr-12">
                    <span>
                        <x-swg.english-swg/>
                    </span>
                    <a href="#">Change Language</a>
                </li>
            </ul>
        </div>
    </div>
</nav>