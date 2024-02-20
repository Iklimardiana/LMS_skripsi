@extends('layouts.master')
@section('title')
    Subject-Student
@endsection
@section('content')
    <div class="mb-2 border-b border-cyan-200 md:ml-64 lg:ml-64">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 text-cyan-500 rounded-t-lg hover:text-cyan-600 hover:border-cyan-300"
                    id="enrolled-tab" data-tabs-target="#enrolled" type="button" role="tab" aria-controls="enrolled"
                    aria-selected="false">Terdaftar</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg text-cyan-500  hover:text-cyan-600 hover:border-cyan-300"
                    id="unenrolled-tab" data-tabs-target="#unenrolled" type="button" role="tab"
                    aria-controls="unenrolled" aria-selected="false">Tidak Terdaftar</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content" class="md:ml-64 lg:ml-64">
        <div class="hidden p-4 rounded-lg " id="enrolled" role="tabpanel" aria-labelledby="enrolled-tab">
            <form id="search" action="/student/subject/" class="w-full mb-3">
                <div class="flex">
                    <div class="relative w-full">
                        <input type="search" name="enrolled_keyword" id="enrolled_keyword"
                            value="{{ request('enrolled_keyword') }}"
                            class="block rounded-l-md p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-cyan-300 focus:ring-cyan-500 focus:border-cyan-500"
                            placeholder="Cari mata pelajaran...">
                        <button type="submit" id="search"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-cyan-500 rounded-e-lg border border-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-cyan-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <div
                class="flex flex-col space-y-3 px-4 pb-4 pt-3 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg">
                @if (session('error'))
                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (session('error'))
                                <p>{{ session('error') }}</p>
                            @endif
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-2" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                @forelse ($enrollment as $enroll)
                    @php
                        $currentProgres = $progres->where('idSubject', $enroll->idSubject)->first();
                        $sequence = $currentProgres ? $currentProgres->sequence : 1;
                        $materialCount = $enroll->subject->material->count();
                        $sequence = $sequence > $materialCount ? $materialCount : $sequence;
                    @endphp
                    <div
                        class="flex items-center justify-between h-36 pr-2 md:pr-3 py-0 pl-0 justify-items-center rounded-lg bg-cyan-50 border border-cyan-500">
                        <div>
                            <img class="rounded-l-lg w-28 md:w-80 h-36 border-y border-cyan-500 object-cover"
                                src="{{ asset('images/thumbnail/' . $enroll->subject->thumbnail) }}" alt="Subject Image">
                        </div>
                        <div class="text-center text-gray-900">
                            <p class="font-semibold text text-lg sm:text-2xl m-3">{{ $enroll->subject->name }}</p>
                            <p class="underline">
                                {{ $enroll->subject->teacher->first_name . ' ' . $enroll->subject->teacher->last_name }}
                            </p>
                        </div>
                        <div class="flex flex-col space-y-2 items-center justify-end">
                            <button type="button"
                                onclick="redirectToMaterialStudent({{ $enroll->idSubject }}, {{ $sequence }})"
                                class=" text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-xs md:text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                Materi
                            </button>
                            <button type="button" onclick="redirectToExam({{ $enroll->idSubject }})"
                                class=" text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-xs md:text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                Ujian
                            </button>
                            <button type="button" onclick="redirectToDiscussion({{ $enroll->idSubject }})"
                                class=" text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-xs md:text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                Diskusi
                            </button>
                        </div>
                    </div>
                @empty
                    <p>Mata Pelajaran yang terdaftar tidak ditemukan</p>
                @endforelse
            </div>
        </div>
        <div class="hidden p-4 rounded-lg" id="unenrolled" role="tabpanel" aria-labelledby="unenrolled-tab">
            <form action="/student/subject/" class="w-full mb-3">
                <div class="flex">
                    <div class="relative w-full">
                        <input type="search" name="unenrolled_keyword" id="unenrolled_keyword"
                            value="{{ request('unenrolled_keyword') }}"
                            class="block rounded-l-md p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-cyan-300 focus:ring-cyan-500 focus:border-cyan-500"
                            placeholder="Cari mata pelajaran...">
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-cyan-500 rounded-e-lg border border-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-cyan-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg">
                @forelse ($subjects as $subject)
                    <div id="subject-item"
                        class="flex items-center justify-between h-36 pr-2 md:pr-3 py-0 pl-0 justify-items-center rounded-lg bg-cyan-50 border border-cyan-500">
                        <div>
                            <img class="rounded-l-lg w-28 md:w-80 h-36 border-y border-cyan-500 object-cover"
                                src="{{ asset('images/thumbnail/' . $subject->thumbnail) }}" alt="Subject Image">
                        </div>
                        <div class="text-center text-gray-900">
                            <p class="font-semibold text text-xl md:text-2xl m-3">{{ $subject->name }}</p>
                            <p class="underline">{{ $subject->teacher->first_name . ' ' . $subject->teacher->last_name }}
                            </p>
                        </div>
                        <div class="flex flex-col space-y-2 items-center justify-end">
                            @if ($subject->enrollment_key !== null)
                                <button type="button" data-modal-target="enrollment-modal"
                                    data-modal-toggle="enrollment-modal"
                                    class=" text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                    Enroll
                                </button>
                            @else
                                <button type="button" onclick="showAlert()"
                                    class=" text-white bg-cyan-500 cursor-not-allowed font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                    Enroll
                                </button>
                            @endif
                        </div>
                        <!-- Main modal -->
                        <div id="enrollment-modal" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div
                                    class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Masukkan Enrollment-Key
                                        </h3>
                                        <button type="button"
                                            class="bg-transparent hover:bg-gray-200 hover:text-cyan-600 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                            data-modal-toggle="enrollment-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="/student/enroll/{{ $subject->enrollment_key }}" method="post"
                                        class="p-4 md:p-5">
                                        @csrf
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="enrollment_key"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Enrollment-Key</label>
                                                <input type="text" name="enrollment_key" id="enrollment_key"
                                                    class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 "
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-start space-x-3">
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                <svg class="me-1 -ms-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                    data-name="Layer 1" viewBox="0 0 64 64" id="save">
                                                    <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10"
                                                        stroke-width="4"
                                                        d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                                    </path>
                                                    <rect width="36" height="24" x="14" y="6" fill="none"
                                                        stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"></rect>
                                                    <rect width="24" height="16" x="18" y="42" fill="none"
                                                        stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"></rect>
                                                    <line x1="26" x2="26" y1="48" y2="58"
                                                        fill="none" stroke="#FFFFFF" stroke-miterlimit="10"
                                                        stroke-width="4"></line>
                                                </svg>
                                                Kirim
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->
                    </div>
                @empty
                    <p>Tidak ada mata pelajaran</p>
                @endforelse
            </div>
        </div>
    </div>
    <script>
        function redirectToMaterialStudent(idSubject, progres) {
            var baseUrl = '/student/materials/';
            var materialUrl = baseUrl + idSubject + '?sequence=' + progres;
            window.location.href = materialUrl;
        }

        function showAlert() {
            alert("Enrollment Key belum di-set oleh guru");
        }

        function redirectToExam(idSubject) {
            var baseUrl = '/student/exam/';
            var examUrl = baseUrl + idSubject;
            window.location.href = examUrl;
        }

        function redirectToDiscussion(idSubject) {
            var discussionUrl = '/discussion/' + idSubject;
            window.location.href = discussionUrl;
        }
    </script>
@endsection
