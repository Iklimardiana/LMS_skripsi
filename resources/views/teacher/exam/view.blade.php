@extends('layouts.master')
@section('title')
    List Ujian
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            @error('title')
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
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
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
            @error('type')
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
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
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
            @error('duration')
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
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
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
            <div class="flex items-center justify-between gap-2 mb-2">
                <a href="/teacher/subject">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
                <button type="button" data-modal-target="addExam-modal" data-modal-toggle="addExam-modal"
                    class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none"
                    title="Klik untuk menambah materi">
                    <svg class="w-5 h-5 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Tambah Ujian
                </button>
                <!-- Main modal -->
                <div id="addExam-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Tambah Ujian
                                </h3>
                                <button type="button"
                                    class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                    data-modal-toggle="addExam-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form action="/teacher/exam/{{ $subject->id }}" method="POST" class="p-4 md:p-5">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                            Ujian</label>
                                        <input type="text" name="title" id="title"
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="duration" class="block mb-2 text-sm font-medium text-gray-900">Durasi
                                            Ujian</label>
                                        <input type="number" name="duration" id="duration"
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block mb-1 text-sm font-medium text-gray-800" for="idTeacher">Pilih
                                            Tipe Ujian</label>
                                        <select
                                            class="bg-gray-50 border border-cyan-500 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                            name="type" id="idTeacher">
                                            <option value="">--Pilih Tipe Ujian--</option>
                                            <option value="pretest" {{ old('type') == 'pretest' ? 'selected' : '' }}>
                                                Pretest
                                            </option>
                                            <option value="postest" {{ old('type') == 'postest' ? 'selected' : '' }}>
                                                Postest
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <svg class="me-1 -ms-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                        data-name="Layer 1" viewBox="0 0 64 64" id="save">
                                        <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"
                                            d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                        </path>
                                        <rect width="36" height="24" x="14" y="6" fill="none" stroke="#FFFFFF"
                                            stroke-miterlimit="10" stroke-width="4"></rect>
                                        <rect width="24" height="16" x="18" y="42" fill="none"
                                            stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"></rect>
                                        <line x1="26" x2="26" y1="48" y2="58"
                                            fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4">
                                        </line>
                                    </svg>
                                    Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end modal -->
            </div>
            <form action="/teacher/exam/{{ $subject->id }}" class="w-full mb-3">
                <div class="flex">
                    <div class="relative w-full">
                        <input type="search" name="keyword" value="{{ request('keyword') }}"
                            class="block rounded-l-md p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-cyan-300 focus:ring-cyan-500 focus:border-cyan-500"
                            placeholder="Cari Judul atau jenis ujian...">
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
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                        <tr>
                            <th scope="col" class="px-1 py-3 border border-cyan-50">
                                No.
                            </th>
                            <th scope="col" class="px-2 py-3 border border-cyan-50">
                                Judul Ujian
                            </th>
                            <th scope="col" class="px-2 py-3 border border-cyan-50">
                                Jenis Ujian
                            </th>
                            <th scope="col" class="px-2 py-3 border border-cyan-50">
                                Aksi Ujian
                            </th>
                            <th scope="col" class="px-2 py-3 border border-cyan-50">
                                Soal Ujian
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($exams as $exam)
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                <td class="px-1 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    {{ $iteration++ }}
                                </td>
                                <td class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    {{ $exam->title }}
                                </td>
                                <td class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    {{ $exam->type }}
                                </td>
                                <td class="p-2 flex flex-items-center justify-center gap-1">
                                    <form action="/teacher/exam/{{ $exam->id }}" method="POST" id="deleteForm">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="showAlertDelete()" title="Hapus Ujian"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form id="statusForm{{ $exam->id }}"
                                        action="/teacher/exam/{{ $exam->id }}/update-status" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" id="statusInput" value="PUT">
                                        <button type="button" onclick="changeStatus({{ $exam->id }})"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Buka Akses Ujian">
                                            @if ($exam->status == '1')
                                                <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H5a1 1 0 0 1-1-1v-7c0-.6.4-1 1-1Z" />
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 16 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M11.5 8V4.5a3.5 3.5 0 1 0-7 0V8M8 12v3M2 8h12a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                    <button type="button" data-modal-target="editExam-modal-{{ $exam->id }}"
                                        data-modal-toggle="editExam-modal-{{ $exam->id }}"
                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                        title="Klik untuk edit ujian">
                                        <svg class="feather feather-edit w-5 h-5" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            viewBox="0 0 24 24" xmlns=" http://www.w3.org/2000/svg">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>
                                    <!-- Main modal -->
                                    <div id="editExam-modal-{{ $exam->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div
                                                class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                                    <h3 class="text-lg font-semibold text-gray-900">
                                                        Edit Ujian
                                                    </h3>
                                                    <button type="button"
                                                        class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                        data-modal-toggle="editExam-modal-{{ $exam->id }}">
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
                                                <form action="/teacher/exam/{{ $exam->id }}" method="POST"
                                                    class="p-4 md:p-5 text-start">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <div class="col-span-2">
                                                            <label for="title"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Nama
                                                                Ujian</label>
                                                            <input type="text" name="title" id="title"
                                                                value="{{ $exam->title }}"
                                                                class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">
                                                        </div>
                                                        <div class="col-span-2">
                                                            <label for="duration"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Durasi
                                                                Ujian</label>
                                                            <input type="number" name="duration" id="duration"
                                                                value="{{ $exam->duration }}"
                                                                class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">
                                                        </div>
                                                        <div class="col-span-2">
                                                            <label class="block mb-1 text-sm font-medium text-gray-800"
                                                                for="idTeacher">Pilih
                                                                Tipe Ujian</label>
                                                            <select
                                                                class="bg-gray-50 border border-cyan-500 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                                                name="type" id="idTeacher">
                                                                <option value="">--Pilih Tipe Ujian--</option>
                                                                <option value="pretest"
                                                                    {{ $exam->type == 'pretest' ? 'selected' : '' }}>
                                                                    Pretest
                                                                </option>
                                                                <option value="postest"
                                                                    {{ $exam->type == 'postest' ? 'selected' : '' }}>
                                                                    Postest
                                                                </option>
                                                            </select>
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
                                                            <rect width="36" height="24" x="14" y="6"
                                                                fill="none" stroke="#FFFFFF" stroke-miterlimit="10"
                                                                stroke-width="4"></rect>
                                                            <rect width="24" height="16" x="18" y="42"
                                                                fill="none" stroke="#FFFFFF" stroke-miterlimit="10"
                                                                stroke-width="4"></rect>
                                                            <line x1="26" x2="26" y1="48"
                                                                y2="58" fill="none" stroke="#FFFFFF"
                                                                stroke-miterlimit="10" stroke-width="4">
                                                            </line>
                                                        </svg>
                                                        Perbarui
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end modal -->
                                </td>
                                <td class="px-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    <div class="flex flex-items-center justify-center gap-1">
                                        <button type="button" title="Klik untuk membuat soal"
                                            onclick="redirectToCreateQuestion({{ $exam->id }})"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none">
                                            <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                        <form action="/teacher/exam/" method="POST" id="deleteForm">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" onclick="showAlertDelete()" title="Hapus seluruh soal"
                                                class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none">
                                                <svg class="w-5 h-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                </svg>
                                            </button>
                                        </form>
                                        <button type="button" title="klik untuk pratinjau soal"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 20 14">
                                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2">
                                                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                    <path
                                                        d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                                </g>
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Klik untuk edit soal">
                                            <svg class="feather feather-edit w-5 h-5" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" viewBox="0 0 24 24" xmlns=" http://www.w3.org/2000/svg">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    Ujian Tidak Ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function showAlertDelete() {
            var isConfirmed = confirm('Yakin ingin menghapus ujian ini?');

            if (isConfirmed) {
                document.getElementById('deleteForm').submit();
            } else {
                console.log('Penghapusan dibatalkan.');
            }
        }

        function redirectToCreateQuestion(idExam) {
            var baseUrl = '/teacher/';
            var cretaeQuestionUrl = baseUrl + idExam + '/question/create';
            window.location.href = cretaeQuestionUrl;
        }

        function changeStatus(examId) {
            console.log("Button Clicked for Exam ID: " + examId);
            var form = document.getElementById('statusForm' + examId);

            if (form) {
                var statusInput = form.querySelector('input[name="status"]');
                console.log(statusInput);

                if (statusInput) {
                    statusInput.value = 'PUT';

                    form.submit();
                } else {
                    console.error("Input status tidak ditemukan dalam formulir.");
                }
            } else {
                console.error("Formulir dengan ID tidak ditemukan.");
            }
        }
    </script>
@endpush
