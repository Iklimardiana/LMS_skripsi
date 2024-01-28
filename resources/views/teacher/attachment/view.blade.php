@extends('layouts.master')
@section('title')
    Tugas Siswa
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="flex items-center justify-between gap-2 mb-2">
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
                                            title="Tugas Siswa" onclick="redirectToLink('{{ $attachment->attachment }}')">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 12 20">
                                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                                    d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6" />
                                            </svg>
                                        </button>
                                    @else
                                        <button type="button"
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
        </div>
    </div>
@endsection
