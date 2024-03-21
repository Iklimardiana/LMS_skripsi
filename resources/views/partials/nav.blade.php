@guest
    <nav class="fixed top-0 w-full border-gray-200 bg-cyan-500 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-5 py-3">
            <a href="/" class="flex items-center space-x-1 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.webp') }}" class="h-10" alt="MicroTika Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">MicroTika</span>
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
                    @if (request()->is('/'))
                        <li>
                            <a href="#aboutUs"
                                class="block py-2 px-3 md:p-0 text-white rounded md:hover:underline md:hover:border-white"
                                aria-current="page">
                                <span class="p-2">
                                    Tentang Kami
                                </span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="@if (request()->is('/') || request()->is('forgot')) /login 
                            @elseif(request()->is('login')) /register 
                            @elseif(request()->is('register')) /login @endif"
                            class="block py-2 px-3 md:p-0 text-white rounded md:hover:underline md:hover:border-white"
                            aria-current="page">
                            <span class="p-2">
                                @if (request()->is('/') || request()->is('forgot'))
                                    Masuk/ Daftar
                                @elseif(request()->is('login'))
                                    Daftar
                                @elseif(request()->is('register'))
                                    Masuk
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endguest

@auth
    <nav class="fixed top-0 w-full border-gray-200 bg-cyan-500 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-5 py-3">
            @if (
                !(request()->is('student/materials*') ||
                    request()->is('student/exam-start*') ||
                    request()->is('/') ||
                    request()->is('discussion*') ||
                    request()->is('student/submission*')
                ))
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 mt-15 ms-3 text-sm text-white rounded-lg sm:hidden hover:bg-transparant focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
            @endif
            <a href="/" class="flex items-center space-x-1 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.webp') }}" class="h-10" class="h-8" alt="MicroTika Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">MicroTika</span>
            </a>
            <div class="flex items-center">
                @if (request()->is('/') && Auth::user()->role == 'student')
                    <ul>
                        <li>
                            <a href="/student/subject"
                                class="block py-2 px-3 font-semibold text-white rounded md:hover:underline md:hover:border-white"
                                aria-current="page">
                                <span class="p-2">
                                    Mata Pelajaran
                                </span>
                            </a>
                        </li>
                    </ul>
                @elseif(request()->is('/') && Auth::user()->role == 'teacher')
                    <ul>
                        <li>
                            <a href="/teacher"
                                class="block py-2 px-3 font-semibold text-white rounded md:hover:underline md:hover:border-white"
                                aria-current="page">
                                <span class="p-2">
                                    Dashboard
                                </span>
                            </a>
                        </li>
                    </ul>
                @elseif(request()->is('/') && Auth::user()->role == 'admin')
                    <ul>
                        <li>
                            <a href="/admin"
                                class="block py-2 px-3 font-semibold text-white rounded md:hover:underline md:hover:border-white"
                                aria-current="page">
                                <span class="p-2">
                                    Dashboard
                                </span>
                            </a>
                        </li>
                    </ul>
                @endif
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ asset('images/avatar/' . Auth::user()->avatar) }}"
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900" role="none">
                                {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                @if (Auth::user()->role == 'admin')
                                    <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-100"
                                        role="menuitem">Dashboard</a>
                                @endif
                                @if (Auth::user()->role == 'teacher')
                                    <a href="/teacher" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-100"
                                        role="menuitem">Dashboard</a>
                                @endif
                                @if (Auth::user()->role == 'student')
                                    <a href="/student/subject"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-100" role="menuitem">Mata
                                        Pelajaran</a>
                                @endif
                            </li>
                            <li>
                                @if (Auth::user()->role == 'teacher')
                                    <a href="/teacher/profile/{{ Auth::user()->id }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-100"
                                        role="menuitem">Profil</a>
                                @endif
                                @if (Auth::user()->role == 'student')
                                    <a href="/student/profile/{{ Auth::user()->id }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-100"
                                        role="menuitem">Profil</a>
                                @endif
                            </li>
                            <li>
                                <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-100"
                                    role="menuitem">Keluar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endauth
