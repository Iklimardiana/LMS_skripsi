@extends('layouts.master')
@section('title')
    Detail Discussion
@endsection
@section('content')
    <div class="p-4 mt-16 sm:mx-20">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="w-7">
                <a href="/discussion/{{ $question->idSubject }}">
                    <svg class="w-6 h-6 text-cyan-500 mb-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
            </div>
            @error('answer')
                <div id="alert-1" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
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
                        data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @enderror
            <div class="flex flex-col min-h-36 p-4 rounded-lg border bg-cyan-50 border-cyan-500 mb-3">
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
                        <button
                            class="flex flex-row justify-between items-center bg-cyan-500 text-white py-1 px-2 rounded-md"
                            type="button" aria-expanded="false"
                            data-modal-target="editDiscussion-modal-{{ $question->id }}"
                            data-modal-toggle="editDiscussion-modal-{{ $question->id }}">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                <path
                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                            </svg>
                            Edit
                        </button>
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
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                                    @forelse ($question->subject->material as $material)
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
                                            Perbarui Diskusi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->
                    @endif
                </div>
                <div class="flex flex-col">
                    <p class="text-justify">
                        {{ $question->question }}
                    </p>
                    @if ($question->image)
                        <img src="{{ asset('/images/discussion/' . $question->image) }}"
                            alt="gambar pertanyaan/ komentar">
                    @endif
                </div>
                <div class="flex mt-4">
                    <svg class="w-7 h-7 text-gray-900 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
                    </svg>
                    <p class="text-gray-900 text-lg">{{ $question->answer_discussion->count() }} jawaban</p>
                </div>
            </div>
            <div class="flex flex-col mt-6">
                <div class="flex items-center">
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('images/avatar/' . auth()->user()->avatar) }}"
                            alt="{{ auth()->user()->first_name . '_' . auth()->user()->last_name }}"
                            class="rounded-full w-8 h-8">
                        <div class="ml-1">
                            <span class="font-medium text-gray-700">
                                {{ strtoupper(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    <form action="/discussion/{{ $question->id }}/reply">
                        <textarea type="text" name="answer" id="answer"
                            class="bg-gray-50 h-28 border border-cyan-400 text-gray-900 text-sm rounded-sm focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                            placeholder="Tuliskan komentar di sini"></textarea>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-sm text-sm px-5 py-2 text-center mt-2">
                                Balas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($question->answer_discussion as $reply)
                <div class="flex flex-col h-auto p-2 rounded-lg bg-gray-50 border border-cyan-500 mt-3">
                    <div class="flex items-center justify-between flex-wrap mb-3">
                        <div class="flex items-center">
                            <div class="flex items-center justify-between">
                                <img src="{{ asset('images/avatar/' . $reply->user->avatar) }}"
                                    alt="{{ $reply->user->first_name . '_' . $reply->user->last_name }}"
                                    class="rounded-full w-8 h-8">
                                <div class="ml-1">
                                    <span class="font-medium text-gray-700">
                                        {{ strtoupper($reply->user->first_name . ' ' . $reply->user->last_name) }}
                                    </span>
                                    <span class="mx-2 inline-block">•</span>
                                    <p class="inline-block text-gray-500 mb-1">
                                        {{ $reply->created_at }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->id === $reply->idUser)
                            <button class="text-gray-800" type="button" aria-expanded="false"
                                data-dropdown-toggle="dropdown-discussion-{{ $reply->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </button>
                            <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                                id="dropdown-discussion-{{ $reply->id }}">
                                <ul class="py-1" role="none">
                                    <li>
                                        <button type="button" data-modal-target="editReply-modal-{{ $reply->id }}"
                                            data-modal-toggle="editReply-modal-{{ $reply->id }}"
                                            class="block px-4 py-2 mx-auto text-sm text-gray-700 hover:bg-cyan-100"
                                            role="menuitem">Edit</button>
                                    </li>
                                    <li>
                                        <form action="/discussion/reply/{{ $reply->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                onclick="deleteData(event, '/discussion/reply/{{ $reply->id }}')"
                                                class="block px-4 py-2 mx-auto text-sm text-gray-700 hover:bg-cyan-100"
                                                role="menuitem">Hapus</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- Main modal -->
                            <div id="editReply-modal-{{ $reply->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-4xl max-h-full">
                                    <!-- Modal content -->
                                    <div
                                        class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                Edit Jawaban
                                            </h3>
                                            <button type="button"
                                                class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                data-modal-toggle="editReply-modal-{{ $reply->id }}">
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
                                        <form action="/discussion/reply/{{ $reply->id }}" method="POST"
                                            enctype="multipart/form-data" class="p-4 md:p-5">
                                            @method('PUT')
                                            @csrf
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="question"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Uraian
                                                        Pertanyaan</label>
                                                    <textarea type="text" name="answer" id="answer"
                                                        class="bg-gray-50 h-28 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">{{ $reply->answer }}</textarea>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Perbarui Jawaban
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                        @endif
                    </div>
                    <div>
                        <p class="text-justify">
                            {{ $reply->answer }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
