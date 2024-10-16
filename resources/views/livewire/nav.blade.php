<div class="relative bg-green">
    <nav class="text-white p-5 md:mx-5 flex justify-between items-center">
        <div class="text-lg  sm:text-4xl">
            <span><i class="fa-brands fa-apple"></i></span>
            Mango Drive
        </div>
        <ul class="flex gap-4 text-2xl items-center justify-between">
            <li class="hidden md:block">
                <a href="#" class="hover:border-b-2 border-orange pb-1 hover:text-lightGreen">About</a>
            </li>
            <li class="hidden md:block"><a href="#"
                    class="hover:border-b-2 border-orange pb-1  hover:text-lightGreen">Home</a>
            </li>
            <li class="hidden md:block"><a href="#"
                    class="hover:border-b-2 border-orange pb-1  hover:text-lightGreen">Menu</a>
            </li>
            <li class="hidden md:block"><a href="#"
                    class="hover:border-b-2 border-orange pb-1  hover:text-lightGreen">Contact</a>
            </li>
            <button
                class="bg-orange text-sm py-2 px-4 md:text-lg md:px-5 text-white rounded-full hover:opacity-75">Login</button>
            <button
                class="bg-orange text-sm py-2 px-4 md:text-lg md:px-5 text-white rounded-full hover:opacity-75">Register</button>
            <button class="block text-3xl md:hidden" wire:click="showMenu">
                @if ($open)
                    <i class="fa-solid fa-xmark"></i>
                @else
                    <i class="fa-solid fa-bars"></i>
                @endif
            </button>
        </ul>
    </nav>
    @if ($open)
        <div class="abosolute top-0 left-0 w-full border-t-2 border-lightGreen md:hidden">
            <nav class="bg-green text-white p-5">
                <ul class="flex flex-col  gap-4 text-md items-center justify-between">
                    <li>
                        <a href="#" class="hover:border-b-2 border-orange pb-1 hover:text-lightGreen">About</a>
                    </li>
                    <li><a href="#" class="hover:border-b-2 border-orange pb-1  hover:text-lightGreen">Home</a>
                    </li>
                    <li><a href="#" class="hover:border-b-2 border-orange pb-1  hover:text-lightGreen">Menu</a>
                    </li>
                    <li><a href="#" class="hover:border-b-2 border-orange pb-1  hover:text-lightGreen">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    @endif
</div>
