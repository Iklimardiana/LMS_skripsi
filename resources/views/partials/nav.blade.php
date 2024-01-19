<nav class="fixed top-0 w-full border-gray-200 bg-cyan-500">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Flowbite</span>
        </a>
        <button data-collapse-toggle="navbar-solid-bg" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-transparant focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-solid-bg" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
            <ul
                class="flex flex-col font-medium mt-4 rounded-lg bg-cyan-700 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="/" class="block py-2 px-2 md:p-0 text-white rounded md:hover:underline"
                        aria-current="page">
                        <span class="p-2">
                            Beranda
                        </span>
                    </a>
                </li>
                @guest
                    <li>
                        <a href="#"
                            class="block py-2 px-3 md:p-0 text-white rounded md:hover:underline md:hover:border-white"
                            aria-current="page">
                            <span class="p-2">
                                Tentang Kami
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="@if (request()->is('/')) /login 
                            @elseif(request()->is('login')) /register 
                            @elseif(request()->is('register')) /login @endif"
                            class="block py-2 px-3 md:p-0 text-white rounded md:hover:underline md:hover:border-white"
                            aria-current="page">
                            <span class="p-2">
                                @if (request()->is('/'))
                                    Masuk/ Daftar
                                @elseif(request()->is('login'))
                                    Daftar
                                @elseif(request()->is('register'))
                                    Masuk
                                @endif
                            </span>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
