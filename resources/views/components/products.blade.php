    @props(['title'])

    <h2 class="text-4xl font-extrabold leading-10 tracking-tight text-gray-800 m-3 p-3 text-center">
        {{ $title }}
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 mx-10 justify-items-center">
        {{ $slot }}
    </div>
