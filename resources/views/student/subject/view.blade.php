@extends('layouts.master')
@section('title')
    Subject-Student
@endsection
@section('content')
    <div class="mb-4 border-b border-gray-200 md:ml-64 lg:ml-64">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="enrolled-tab" data-tabs-target="#enrolled"
                    type="button" role="tab" aria-controls="enrolled" aria-selected="false">enrolled</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="unenrolled-tab" data-tabs-target="#unenrolled" type="button" role="tab"
                    aria-controls="unenrolled" aria-selected="false">unenrolled</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content" class="md:ml-64 lg:ml-64">
        <div class="hidden p-4 rounded-lg " id="enrolled" role="tabpanel" aria-labelledby="enrolled-tab">
            <div class="flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg">
                @forelse ($enrollment as $enroll)
                    <div
                        class="flex items-center justify-between h-36 pr-2 md:pr-3 py-0 pl-0 justify-items-center rounded-lg bg-cyan-50 border border-cyan-500">
                        <div>
                            <img class="rounded-l-lg w-28 md:w-80 h-36 border-y border-cyan-500 object-cover"
                                src="{{ asset('images/thumbnail/' . $enroll->subject->thumbnail) }}" alt="Subject Image">
                        </div>
                        <div class="text-center text-gray-900">
                            <p class="font-semibold text text-xl md:text-2xl m-3">{{ $enroll->subject->name }}</p>
                            <p class="underline">
                                {{ $enroll->subject->teacher->first_name . ' ' . $enroll->subject->teacher->last_name }}</p>
                        </div>
                        <div class="flex flex-col space-y-2 items-center justify-end">
                            <button type="button" onclick="redirectToMaterial()"
                                class=" text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                Materi
                            </button>
                            <button type="button" onclick="redirectToExam()"
                                class=" text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                Ujian
                            </button>
                        </div>
                    </div>
                @empty
                    <p>Belum ada mata pelajaran yang di-enroll</p>
                @endforelse
            </div>
        </div>
        <div class="hidden p-4 rounded-lg" id="unenrolled" role="tabpanel" aria-labelledby="unenrolled-tab">
            <div class="flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg">
                @forelse ($subjects as $subject)
                    <div
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
                            <button type="button" data-modal-target="enrollment-modal" data-modal-toggle="enrollment-modal"
                                class=" text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                Enroll
                            </button>
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
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5">
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="subject"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Enrollment-Key</label>
                                                <input type="text" name="subject" id="subject"
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
                    <p>Belum Ada Mata Pelajaran</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
