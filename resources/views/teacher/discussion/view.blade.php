@extends('layouts.master')
@section('title')
    Forum Diskusi
@endsection
@section('content')
    <div class="p-4 mt-16 sm:mx-20">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="flex items-center justify-between">
                <div class="flex flex-start items-center gap-2">
                    @if (Auth::user()->role === 'teacher')
                        <a href="/teacher/subject">
                            <svg class="w-6 h-6 text-cyan-500 mb-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                        </a>
                    @elseif(Auth::user()->role === 'student')
                        <a href="/student/subject">
                            <svg class="w-6 h-6 text-cyan-500 mb-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                        </a>
                    @endif
                    <!-- start modal -->
                    <button data-modal-target="addDiscussion-modal" data-modal-toggle="addDiscussion-modal"
                        class="flex items-center text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                        <svg class="w-5 h-5 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Membuat Diskusi Baru
                    </button>
                </div>

                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-white mb-2 bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                    type="button">Pilih Modul <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('discussion.view', ['idSubject' => $subject->id, 'material' => '']) }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                        </li>
                        @foreach ($materials as $materialId => $materialName)
                            <li>
                                <a href="{{ route('discussion.view', ['idSubject' => $subject->id, 'material' => $materialId]) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ $materialName }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Main modal -->
            <div id="addDiscussion-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Tambah Diskusi Baru
                            </h3>
                            <button type="button"
                                class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                data-modal-toggle="addDiscussion-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="/discussion/{{ $subject->id }}" method="POST" enctype="multipart/form-data"
                            class="p-4 md:p-5">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-800" for="idMaterial">Pilih
                                        Materi</label>
                                    <select
                                        class="bg-gray-50 border border-cyan-500 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                        name="idMaterial" id="idMaterial">
                                        <option value="">--Pilih Materi--</option>
                                        @forelse ($subject->material as $material)
                                            <option value="{{ $material->id }}">
                                                {{ $material->name }}</option>
                                        @empty
                                            <option value="">Tidak Ada Materi</option>
                                        @endforelse
                                    </select>
                                </div>
                                @error('idMaterial')
                                    {{ $message }}
                                @enderror
                                <div class="col-span-2">
                                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900">Uraian
                                        Pertanyaan</label>
                                    <textarea type="text" name="question" id="question"
                                        class="bg-gray-50 h-28 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 "></textarea>
                                </div>
                                @error('questio')
                                    {{ $message }}
                                @enderror
                                <div class="col-span-2">
                                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Unggah
                                        Gambar</label>
                                    <input type="file" name="image" id="image"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full">
                                </div>
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Kirim Diskusi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @error('idMaterial')
                <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
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
            @error('question')
                <div id="alert-4" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-4" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @enderror
            @error('image')
                <div id="alert-5" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-5" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @enderror
            <!-- end modal -->
            @forelse ($questions as $question)
                <div class="flex flex-col min-h-36 p-2 rounded-lg bg-cyan-50 border border-cyan-500 mb-3">
                    <div class="flex items-center justify-between flex-wrap mb-3">
                        <div class="flex items-center">
                            <div class="flex items-center justify-between">
                                <img src="{{ asset('images/avatar/' . $question->user->avatar) }}"
                                    alt="{{ $question->user->first_name . '_' . $question->user->last_name }}"
                                    class="rounded-full w-8">
                                <div class="ml-1">
                                    <span class="font-medium text-gray-700">
                                        {{ strtoupper($question->user->first_name . ' ' . $question->user->last_name) }}
                                    </span>
                                    <span class="mx-2 inline-block">•</span>
                                    <p class="inline-block text-gray-500 mb-1">
                                        {{ $question->created_at }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->id === $question->idUser)
                            <button class="text-gray-800" type="button" aria-expanded="false"
                                data-dropdown-toggle="dropdown-discussion-{{ $question->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </button>
                            <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                                id="dropdown-discussion-{{ $question->id }}">
                                <ul class="py-1" role="none">
                                    <li>
                                        <button type="button"
                                            data-modal-target="editDiscussion-modal-{{ $question->id }}"
                                            data-modal-toggle="editDiscussion-modal-{{ $question->id }}"
                                            class="block px-4 py-2 mx-auto text-sm text-gray-700 hover:bg-cyan-100"
                                            role="menuitem">Edit</button>
                                    </li>
                                    <li>
                                        <form action="/discussion/{{ $question->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="block px-4 py-2 mx-auto text-sm text-gray-700 hover:bg-cyan-100"
                                                role="menuitem">Hapus</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                        <!-- Main modal -->
                        <div id="editDiscussion-modal-{{ $question->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-4xl max-h-full">
                                <!-- Modal content -->
                                <div
                                    class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Edit Komentar/ Peratanyaan
                                        </h3>
                                        <button type="button"
                                            class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                            data-modal-toggle="editDiscussion-modal-{{ $question->id }}">
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
                                    <form action="/discussion/{{ $question->id }}" method="POST"
                                        enctype="multipart/form-data" class="p-4 md:p-5">
                                        @method('PUT')
                                        @csrf
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label class="block mb-1 text-sm font-medium text-gray-800"
                                                    for="idMaterial">Pilih
                                                    Materi</label>
                                                <select
                                                    class="bg-gray-50 border border-cyan-500 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                                    name="idMaterial" id="idMaterial">
                                                    <option value="">--Pilih Materi--</option>
                                                    @forelse ($subject->material as $material)
                                                        <option value="{{ $material->id }}"
                                                            @if ($material->id == $question->idMaterial) selected @endif>
                                                            {{ $material->name }}</option>
                                                    @empty
                                                        <option value="">Tidak Ada Materi</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="question"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Uraian
                                                    Pertanyaan</label>
                                                <textarea type="text" name="question" id="question"
                                                    class="bg-gray-50 h-28 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">{{ $question->question }}</textarea>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="image"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Unggah
                                                    Gambar</label>
                                                <input type="file" name="image" id="image"
                                                    class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full">
                                                <span>{{ $question->image }}</span>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Kirim Diskusi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->
                    </div>
                    <div>
                        <p class="text-justify">
                            {{ strlen($question->question) > 255 ? substr($question->question, 0, 255) . '...' : $question->question }}
                        </p>
                    </div>
                    <div class="flex mt-2">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
                        </svg>
                        <p class="text-gray-900">{{ $question->answer_discussion->count() }} jawaban</p>
                    </div>
                </div>
            @empty
                <p class="font-medium text-xl text-center">Belum ada diskusi</p>
            @endforelse
        </div>
    </div>
@endsection
