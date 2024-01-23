@extends('layouts.master')
@section('title')
    subject-teacher
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            @error('enrollment_key')
                <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @enderror
            @error('enrollment_key_confirmation')
                <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @enderror
            @if (!empty($subjects))
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($subjects as $subject)
                        <div
                            class="flex flex-col h-auto justify-between items-center rounded-lg bg-cyan-50 border border-cyan-500">
                            <img class="w-full rounded-t-lg h-40 object-cover"
                                src="{{ asset('images/thumbnail/' . $subject->thumbnail) }}" alt="image subject">
                            <div
                                class="flex lg:flex-row flex-col items-center justify-between w-full mx-5 p-3 text-gray-900">
                                <span class="font-semibold text-lg md:text-2xl md:text-center">{{ $subject->name }}</span>
                                <span class="font-light text-end">
                                    {{ $subject->Teacher->first_name }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-y-1 items-end justify-center w-full mx-5 p-3 text-gray-900">
                                <button type="button" onclick="redirectToStudent('{{ $subject->id }}')"
                                    class=" text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                    Siswa
                                </button>
                                <button type="button" onclick="redirectToMaterial()"
                                    class=" text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                    Materi
                                </button>
                                <button type="button" onclick="redirectToExam()"
                                    class=" text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                    Ujian
                                </button>
                                <button type="button"
                                    class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm md:w-20 w-auto px-1 py-1 md:py-2 me-2 focus:outline-none"
                                    title="edit mata pelajaran" data-modal-target="setting-modal-{{ $subject->id }}"
                                    data-modal-toggle="setting-modal-{{ $subject->id }}">
                                    Pengaturan
                                </button>
                                <div id="setting-modal-{{ $subject->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div
                                            class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    Pembuatan Enrollment Key
                                                </h3>
                                                <button type="button"
                                                    class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                    data-modal-toggle="setting-modal-{{ $subject->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form action="/teacher/subject/{{ $subject->id }}" method="POST"
                                                enctype="multipart/form-data" class="p-4 md:p-5">
                                                @method('PUT')
                                                @csrf
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="enrollment"
                                                            class="block mb-2 text-sm font-medium text-start text-gray-900">Enrollment
                                                            Key</label>
                                                        <input type="text" name="enrollment_key" id="enrollment"
                                                            class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 "
                                                            value="{{ $subject->enrollment_key }}">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="enrollment_conrifm"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi
                                                            Enrollment-Key</label>
                                                        <input type="text" name="enrollment_key_confirmation"
                                                            id="enrollment_confirm"
                                                            class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 ">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label class="block mb-1 text-sm font-medium text-gray-900"
                                                            for="thumbnail">Ganti gambar</label>
                                                        <input type="file" name="thumbnail" id="thumbnail"
                                                            class="block w-full text-sm text-gray-900 border border-cyan-400 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-cyan-500"
                                                            aria-describedby="file_input_help" id="file_input">
                                                        <span class="mt-1 text-sm text-gray-500" id="file_input_help">
                                                            {{ $subject->thumbnail ?: 'No file chosen' }}</span>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    <svg class="me-1 -ms-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        data-name="Layer 1" viewBox="0 0 64 64" id="save">
                                                        <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10"
                                                            stroke-width="4"
                                                            d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                                        </path>
                                                        <rect width="36" height="24" x="14" y="6" fill="none"
                                                            stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4">
                                                        </rect>
                                                        <rect width="24" height="16" x="18" y="42" fill="none"
                                                            stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4">
                                                        </rect>
                                                        <line x1="26" x2="26" y1="48"
                                                            y2="58" fill="none" stroke="#FFFFFF"
                                                            stroke-miterlimit="10" stroke-width="4"></line>
                                                    </svg>
                                                    Simpan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-900 font-semibold text-lg text-center">Tidak ada mata pelajaran</p>
                </div>
            @endif
        </div>
    </div>
@endsection
