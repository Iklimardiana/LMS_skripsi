@if (!in_array(request()->path(), ['login', 'register', '/']))
    @if (
        !(request()->is('student/materials*') ||
            request()->is('student/exam-start*') ||
            request()->is('student/submission*') ||
            request()->is('discussion*')
        ))
        <aside id="logo-sidebar"
            class="fixed top-16 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-cyan-50">
                <a href="https://flowbite.com/" class="flex items-center justify-center ps-2.5 mb-5">
                    <img src="{{ asset('images/logo.png') }}" class="h-8 me-3 sm:h-14 self-center" alt="Logo" />
                </a>
                <ul class="space-y-2 font-medium">
                    @if (auth()->user()->role == 'admin')
                        <li>
                            <a href="/admin"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ request()->is('admin') ? ' active' : '' }}">
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 22 21">
                                    <path
                                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                    <path
                                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                </svg>
                                <span class="ms-3">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/teacher"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ request()->is('admin/teacher*') ? ' active' : '' }}">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 18">
                                    <path
                                        d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Guru</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/student"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ request()->is('admin/student*') ? ' active' : '' }}">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 19">
                                    <path
                                        d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                    <path
                                        d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap">Siswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/subject"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ request()->is('admin/subject') ? ' active' : '' }}">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="/logout"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                    id="logout-tab" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 16 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth()->user()->role == 'teacher')
                        <li>
                            <a href="/teacher"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ request()->is('teacher') ? ' active' : '' }}">
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 22 21">
                                    <path
                                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                    <path
                                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                </svg>
                                <span class="ms-3">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="/teacher/subject"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ str_contains(request()->url(), 'teacher/exam') || str_contains(request()->url(), 'teacher/subject') || str_contains(request()->url(), 'teacher/materials') || str_contains(request()->url(), 'teacher/attachment') || request()->is('teacher/*/question*') || request()->is('teacher/*/assignment*') ? 'active' : '' }}">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="/teacher/profile/{{ Auth::user()->id }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ request()->is('teacher/profile*') ? ' active' : '' }}">
                                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="/logout"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                    id="logout-tab" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 16 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth()->user()->role == 'student')
                        <li>
                            <a href="/student/subject"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ (request()->is('student/subject*') ? ' active' : '' || request()->is('student/exam*')) ? ' active' : '' }}">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="/student/profile/{{ Auth::user()->id }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group {{ request()->is('student/profile*') ? ' active' : '' }}">
                                <svg class="w-5 h-5 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="/logout"
                                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-white hover:border hover:border-cyan-500 group">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                    id="logout-tab" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 16 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
                            </a>
                        </li>
                    @endif
                </ul>
        </aside>
    @endif
@endif
