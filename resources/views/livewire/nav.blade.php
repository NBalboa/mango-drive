<div>
    <nav class="bg-white w-full z-20 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <x-logo to="/">Mango Drive</x-logo>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <x-cta-link>Login</x-cta-link>
                <x-menu-button wire:click="showMenu" />
            </div>
            <div class="items-center justify-between {{ !$open ? 'hidden' : '' }} w-full md:flex md:w-auto md:order-1"
                id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                    @foreach ($LINKS as $LINK)
                        <x-nav-item to="{{ $LINK['to'] }}"
                            isActive="{{ $LINK['active'] }}">{{ $LINK['name'] }}</x-nav-item>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</div>
