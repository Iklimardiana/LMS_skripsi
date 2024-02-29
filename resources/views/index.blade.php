@extends('layouts.master')
@section('title')
    Beranda
@endsection
@section('content')
    <div class="mb-16 mx-10 px-8">
        <div class="grid max-w-screen-xl py-14 md:grid-cols-12 gap-2 lg:grid-cols-12">
            <div class="md:flex md:col-span-6">
                <div class="mr-auto place-self-center">
                    <div class="flex flex-col max-w-2xl mb-4 leading-none tracking-tight md:text-3xl text-xl">
                        <span class="font-bold text-5xl mb-5 text-cyan-800">
                            Selamat datang di MyEdu
                        </span>
                        <span class="font-semibold text-slate-800">
                            Learning Management System Interaktif untuk Meningkatkan Pendidikan!
                        </span>
                    </div>
                    <p class=" max-w-2xl mb-6 font-normal text-slate-500 lg:mb-8 md:text-lg lg:text-xl">
                        MyEdu hadir sebagai solusi untuk mendukung pengalaman belajar di sekolah. Dengan antarmuka yang
                        ramah
                        pengguna, MyEdu menyediakan akses mudah dan cepat ke berbagai sumber daya pembelajaran, alat
                        kolaborasi,
                        dan pengelolaan tugas yang dirancang untuk meningkatkan pengalaman belajar Anda.
                    </p>
                </div>
            </div>
            <div class="flex items-center md:mt-0 md:col-span-6">
                <img class="w-full h-auto" src="./images/hero.png" alt="hero image">
            </div>
        </div>
        <div class="border-t-4 border-cyan-800 pt-2 sm:px-12">
            <h1 class="text-center sm:text-4xl text-2xl font-semibold text-cyan-800">
                Fitur-Fitur LMS
            </h1>
            <div class="flex flex-col md:flex-row justify-between gap-2 pt-10 pb-2 z-10 text-cyan-800">
                <div class="group cursor-default relative block h-48 md:h-64 w-full"><span
                        class="absolute inset-0 border-2 border-dashed border-cyan-800"></span>
                    <div
                        class="relative flex h-full transform items-end border-2 border-cyan-800 bg-white transition duration-500 group-hover:-translate-x-2  group-hover:-translate-y-2 ">
                        <div class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                            <span>
                                <svg class="w-12 h-12 text-xl text-cyan-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-xl font-medium sm:text-2xl">Forum Diskusi</h2>
                        </div>
                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:transition group-hover:duration-500 group-hover:opacity-100 sm:p-6 lg:p-8">
                            <h3 class="mt-4 text-xl font-medium sm:text-2xl">Forum Diskusi</h3>
                            <p class="mt-4 text-sm sm:text-base">Memfasilitasi kolaborasi dan pertukaran informasi antar
                                siswa dan guru, mendorong interaksi dan pembelajaran bersama secara online</p>
                        </div>
                    </div>
                </div>
                <div class="group cursor-default relative block h-48 md:h-64 w-full"><span
                        class="absolute inset-0 border-2 border-dashed border-cyan-800"></span>
                    <div
                        class="relative flex h-full transform items-end border-2 border-cyan-800 bg-white transition duration-500 group-hover:-translate-x-2  group-hover:-translate-y-2 ">
                        <div class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                            <span class="text-5xl">
                                <svg class="w-12 h-12 text-cyan-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M4 4v15c0 .6.4 1 1 1h15M8 16l2.5-5.5 3 3L17.3 7 20 9.7" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-xl font-medium sm:text-2xl">Progres Belajar</h2>
                        </div>
                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:transition group-hover:duration-500 group-hover:opacity-100 sm:p-6 lg:p-8">
                            <h3 class="mt-4 text-xl font-medium sm:text-2xl">Progres Belajar</h3>
                            <p class="mt-4 text-sm sm:text-base">Progres belajar memantau kemajuan siswa dan memberikan
                                umpan balik untuk meningkatkan pengalaman pembelajaran personal.</p>
                        </div>
                    </div>
                </div>
                <div class="group cursor-default relative block h-48 md:h-64 w-full"><span
                        class="absolute inset-0 border-2 border-dashed border-cyan-800"></span>
                    <div
                        class="relative flex h-full transform items-end border-2 border-cyan-800 bg-white transition duration-500 group-hover:-translate-x-2  group-hover:-translate-y-2">
                        <div class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                            <span class="text-5xl">
                                <svg class="w-12 h-12 text-cyan-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 4h3c.6 0 1 .4 1 1v15c0 .6-.4 1-1 1H6a1 1 0 0 1-1-1V5c0-.6.4-1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-xl font-medium sm:text-2xl">Pengumpulan Tugas</h2>
                        </div>
                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:transition group-hover:duration-500 group-hover:opacity-100 sm:p-6 lg:p-8">
                            <h3 class="mt-4 text-xl font-medium sm:text-2xl">Pengumpulan Tugas</h3>
                            <p class="mt-4 text-sm sm:text-base">Fitur pengumpulan tugas di LMS memudahkan siswa mengirimkan
                                pekerjaan, serta memperkaya proses evaluasi dan interaksi dalam pembelajaran.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between gap-2 pb-10 z-10 text-cyan-800">
                <div class="group cursor-default relative block h-48 md:h-64 w-full"><span
                        class="absolute inset-0 border-2 border-dashed border-cyan-800"></span>
                    <div
                        class="relative flex h-full transform items-end border-2 border-cyan-800 bg-white transition duration-500 group-hover:-translate-x-2  group-hover:-translate-y-2 ">
                        <div class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                            <span>
                                <svg class="w-12 h-12 text-gcyan-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6v13m0-13c-2.8-.8-4.7-1-8-1a1 1 0 0 0-1 1v11c0 .6.5 1 1 1 3.2 0 5 .2 8 1m0-13c2.8-.8 4.7-1 8-1 .6 0 1 .5 1 1v11c0 .6-.5 1-1 1-3.2 0-5 .2-8 1" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-xl font-medium sm:text-2xl">Materi Terstruktur</h2>
                        </div>
                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:transition group-hover:duration-500 group-hover:opacity-100 sm:p-6 lg:p-8">
                            <h3 class="mt-4 text-xl font-medium sm:text-2xl">Materi Terstruktur</h3>
                            <p class="mt-4 text-sm sm:text-base"> Konten pembelajaran yang disusun dengan format yang jelas
                                dan berurutan, memudahkan siswa untuk memahami konsep secara sistematis dan teratur.</p>
                        </div>
                    </div>
                </div>
                <div class="group cursor-default relative block h-48 md:h-64 w-full"><span
                        class="absolute inset-0 border-2 border-dashed border-cyan-800"></span>
                    <div
                        class="relative flex h-full transform items-end border-2 border-cyan-800 bg-white transition duration-500 group-hover:-translate-x-2  group-hover:-translate-y-2 ">
                        <div class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                            <span>
                                <svg id="Layer_1" class="w-12 h-12 fill-current text-cyan-800" data-name="Layer 1"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 97.45 122.88">
                                    <title>exam</title>
                                    <path
                                        d="M24.19,50.27H18.65v2.1h6.79V56.8H13.12V39.5H25.3l-.69,4.43h-6v2.32h5.54v4Zm3.62,40.84a2.22,2.22,0,0,1,3.16,0,2.28,2.28,0,0,1,0,3.2l-2.74,2.8L31,99.91a2.24,2.24,0,0,1,0,3.17,2.22,2.22,0,0,1-3.15,0l-2.72-2.78-2.74,2.79a2.22,2.22,0,0,1-3.16,0,2.27,2.27,0,0,1,0-3.2l2.76-2.81-2.76-2.8a2.25,2.25,0,0,1,0-3.18,2.23,2.23,0,0,1,3.15,0l2.72,2.78,2.74-2.79ZM17.29,76a2.73,2.73,0,1,1,4.54-3l1.48,1.63,5.18-6.46a2.72,2.72,0,1,1,4.21,3.46l-7.4,8.94a3.78,3.78,0,0,1-.65.61,2.74,2.74,0,0,1-3.8-.75L17.29,76ZM37.66,5.12V10.2a2.57,2.57,0,0,1-2.32,2.54,2.92,2.92,0,0,1-.9.13H25V23.39H72.44V12.88H63a2.88,2.88,0,0,1-.9-.13,2.57,2.57,0,0,1-2.32-2.54V5.13ZM23.73,28.61A3.92,3.92,0,0,1,21,27.48c-.09-.1-.13-.19-.22-.28a3.92,3.92,0,0,1-.9-2.45V19.58H5.67a.47.47,0,0,0-.4.18.73.73,0,0,0-.19.42v97a.43.43,0,0,0,.19.41.56.56,0,0,0,.4.18H91.78a.56.56,0,0,0,.4-.18.45.45,0,0,0,.19-.41v-97a.68.68,0,0,0-.19-.41.5.5,0,0,0-.4-.18H77.57v5.17a4,4,0,0,1-.9,2.45c-.09.09-.14.18-.23.28a3.9,3.9,0,0,1-2.72,1.13Zm-18,94.27a5.67,5.67,0,0,1-4-1.68,5.62,5.62,0,0,1-1.68-4v-97a5.6,5.6,0,0,1,1.68-4,5.62,5.62,0,0,1,4-1.68H19.92V11.66a3.8,3.8,0,0,1,1.13-2.73,3.88,3.88,0,0,1,2.73-1.14h8.8V4.27a4.19,4.19,0,0,1,1.27-3,4.2,4.2,0,0,1,3-1.27H60.6a4.23,4.23,0,0,1,3,1.27,4.23,4.23,0,0,1,1.27,3V7.8h8.8a3.89,3.89,0,0,1,3.86,3.87v2.81H91.74a5.74,5.74,0,0,1,5.71,5.71v97a5.6,5.6,0,0,1-1.68,4,5.71,5.71,0,0,1-4,1.68ZM77.6,76.27a2.58,2.58,0,1,0,0-5.16H43.25a2.58,2.58,0,0,0,0,5.16Zm0,23.34a2.58,2.58,0,1,0,0-5.16H43.25a2.58,2.58,0,0,0,0,5.16ZM33.73,39.5l1.91,4.62h.28l1.91-4.62h6L40,47.86l3.85,8.94H37.69l-2.08-5h-.25l-2,5H27.44L31.21,48,27.44,39.5ZM50.38,56.8H44.54L49,39.5h8.55l4.49,17.3H56.23l-.64-2.74H51l-.64,2.74Zm2.78-12L52,49.66h2.55l-1.11-4.85Zm15.89,12H63.26l1.06-17.3h7.22l2.16,8.8h.2l2.15-8.8h7.23l1,17.3H78.55l-.34-8.39H78l-2.1,8.39H71.68l-2.13-8.39h-.17l-.33,8.39Z"
                                        stroke="currentColor" stroke-width="2" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-xl font-medium sm:text-2xl">Ujian</h2>
                        </div>
                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:transition group-hover:duration-500 group-hover:opacity-100 sm:p-6 lg:p-8">
                            <h3 class="mt-4 text-xl font-medium sm:text-2xl">Ujian</h3>
                            <p class="mt-4 text-sm sm:text-base">Fitur untuk membuat, melaksanakan, dan menilai tes secara
                                daring, memberikan cara efisien untuk mengukur pemahaman siswa terhadap materi pembelajaran.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="group cursor-default relative block h-48 md:h-64 w-full"><span
                        class="absolute inset-0 border-2 border-dashed border-cyan-800"></span>
                    <div
                        class="relative flex h-full transform items-end border-2 border-cyan-800 bg-white transition duration-500 group-hover:-translate-x-2  group-hover:-translate-y-2 ">
                        <div class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                            <span class="text-5xl">
                                <svg class="w-12 h-12 text-cyan-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m10.8 17.8-6.4 2.1 2.1-6.4m4.3 4.3L19 9a3 3 0 0 0-4-4l-8.4 8.6m4.3 4.3-4.3-4.3m2.1 2.1L15 9.1m-2.1-2 4.2 4.2" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-xl font-medium sm:text-2xl">Penilaian</h2>
                        </div>
                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:transition group-hover:duration-500 group-hover:opacity-100 sm:p-6 lg:p-8">
                            <h3 class="mt-4 text-xl font-medium sm:text-2xl">Penilaian</h3>
                            <p class="mt-4 text-sm sm:text-base">Umpan balik berupa pemberian nilai dari guru kepada siswa
                                yang telah mengerjakan tugas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="aboutUs" class="border-t-4 border-cyan-800 pt-2 sm:px-12">
            <h1 class="text-center sm:text-4xl text-2xl font-semibold text-cyan-800">
                Tentang Kami
            </h1>
            <p class="text-center mt-2 text-lg font-normal text-cyan-800">
                Didorong oleh semangat untuk meningkatkan motivasi belajar siswa, LMS ini didesain untuk memberikan
                solusi yang efektif dan efisien dalam mengorganisir materi pembelajaran. LMS kami hadir sebagai solusi
                yang dapat memberikan semangat dan kreativitas siswa dalam belajar. LMS yang telah kami kembangkan
                menyediakan alat yang intuitif untuk mengorganisir materi, memberikan tugas, dan secara akurat memantau
                progres setiap siswa secara efisien. Dengan LMS ini, kami ingin membuka pintu menuju pembelajaran yang
                lebih inspiratif dan memberdayakan setiap pelajar dan pendidik untuk mencapai potensi penuh mereka.
            </p>
        </div>
    </div>
@endsection
