@extends('layouts.master')
@section('title')
    Tugas Siswa
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <form action="/teacher/attachment/{{ $material->id }}" class="w-full mb-3">
            <div class="flex">
                <div class="relative w-full">
                    <input type="search" name="keyword" value="{{ request('keyword') }}"
                        class="block rounded-l-md p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-cyan-300 focus:ring-cyan-500 focus:border-cyan-500"
                        placeholder="Cari nama siswa...">
                    <button type="submit"
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
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            @error('score')
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
            <div class="flex items-center mb-2">
                <a href="/teacher/materials/{{ $material->idSubject }}">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-900">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Lampiran Tugas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi Nilai
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($attachments as $attachment)
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 b border border-cyan-500">
                                <td class="px-6 py-1">
                                    {{ $iteration++ }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $attachment->user->first_name . ' ' . $attachment->user->last_name }}
                                </td>
                                <td class="px-6 py-1">
                                    @if ($attachment->type === 'link')
                                        <button type="button"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Tugas Siswa"
                                            onclick="previewAssignment('{{ $attachment->type }}', '{{ $attachment->attachment }}', '{{ $attachment->user->role }}')">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 12 20">
                                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                                    d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6" />
                                            </svg>
                                        </button>
                                    @else
                                        <button type="button"
                                            onclick="previewAssignment('{{ $attachment->type }}', '{{ $attachment->attachment }}', '{{ $attachment->user->role }}')"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Tugas Siswa">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 16 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M4.828 10h6.239m-6.239 4h6.239M6 1v4a1 1 0 0 1-1 1H1m14-4v16a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2Z" />
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                                <td class="px-6 py-1">
                                    @if ($attachment->score === null && $attachment->category === 'fromstudent')
                                        <button data-modal-target="score-modal-{{ $attachment->id }}"
                                            data-modal-toggle="score-modal-{{ $attachment->id }}"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none">
                                            Beri Nilai
                                        </button>
                                        <div id="score-modal-{{ $attachment->id }}" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <!-- Modal content -->
                                                <div
                                                    class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            @if ($attachment->user->role === 'student')
                                                                Nilai untuk {{ $attachment->user->first_name }}
                                                            @endif
                                                        </h3>
                                                        <button type="button"
                                                            class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                            data-modal-toggle="score-modal-{{ $attachment->id }}">
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
                                                    <div class="flex flex-col justify-start text-start">
                                                        <form action="/teacher/attachment/score/{{ $attachment->id }}"
                                                            method="POST" class="p-4 md:p-5">
                                                            @method('put')
                                                            @csrf
                                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                                <div class="col-span-2">
                                                                    <label for="score"
                                                                        class="block mb-2 text-sm font-medium text-gray-900">Nilai</label>
                                                                    <input type="text" name="score" id="score"
                                                                        class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 "
                                                                        required="">
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                                <svg class="me-1 -ms-1 w-5 h-5"
                                                                    xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                                                    viewBox="0 0 64 64" id="save">
                                                                    <path fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4"
                                                                        d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                                                    </path>
                                                                    <rect width="36" height="24" x="14" y="6"
                                                                        fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4"></rect>
                                                                    <rect width="24" height="16" x="18" y="42"
                                                                        fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4"></rect>
                                                                    <line x1="26" x2="26" y1="48"
                                                                        y2="58" fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4">
                                                                    </line>
                                                                </svg>
                                                                Simpan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        {{ $attachment->score }}
                                    @endif
                                </td>
                                <td class="px-6 py-1">
                                    @if ($attachment->score !== null && $attachment->category === 'fromstudent')
                                        <button type="button" data-modal-target="editScore-modal-{{ $attachment->id }}"
                                            data-modal-toggle="editScore-modal-{{ $attachment->id }}"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Klik untuk edit nilai">
                                            <svg class="feather feather-edit w-5 h-5" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" viewBox="0 0 24 24" xmlns=" http://www.w3.org/2000/svg">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </button>
                                        <div id="editScore-modal-{{ $attachment->id }}" tabindex="-1"
                                            aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <!-- Modal content -->
                                                <div
                                                    class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            @if ($attachment->user->role === 'student')
                                                                Edit Nilai untuk {{ $attachment->user->first_name }}
                                                            @endif
                                                        </h3>
                                                        <button type="button"
                                                            class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                            data-modal-toggle="editScore-modal-{{ $attachment->id }}">
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
                                                    <div class="flex flex-col justify-start text-start">
                                                        <form action="/teacher/attachment/score/{{ $attachment->id }}"
                                                            method="POST" class="p-4 md:p-5">
                                                            @method('put')
                                                            @csrf
                                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                                <div class="col-span-2">
                                                                    <label for="score"
                                                                        class="block mb-2 text-sm font-medium text-gray-900">Nilai</label>
                                                                    <input type="text" name="score" id="score"
                                                                        value="{{ $attachment->score }}"
                                                                        class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 "
                                                                        required="">
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                                <svg class="me-1 -ms-1 w-5 h-5"
                                                                    xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                                                    viewBox="0 0 64 64" id="save">
                                                                    <path fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4"
                                                                        d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                                                    </path>
                                                                    <rect width="36" height="24" x="14" y="6"
                                                                        fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4"></rect>
                                                                    <rect width="24" height="16" x="18" y="42"
                                                                        fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4"></rect>
                                                                    <line x1="26" x2="26" y1="48"
                                                                        y2="58" fill="none" stroke="#FFFFFF"
                                                                        stroke-miterlimit="10" stroke-width="4">
                                                                    </line>
                                                                </svg>
                                                                Simpan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button type="button" onclick="showAlert()"
                                            class="text-white bg-cyan-500 cursor-not-allowed font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Klik untuk edit nilai">
                                            <svg class="feather feather-edit w-5 h-5" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" viewBox="0 0 24 24" xmlns=" http://www.w3.org/2000/svg">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    Belum ada pengumpulan tugas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $attachments->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    <script>
        function showAlert() {
            alert('Belum ada nilai')
        }
    </script>
@endsection
