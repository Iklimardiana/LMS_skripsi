@extends('layouts.master')
@section('title')
    subject-admin
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <!-- start modal -->
            <button data-modal-target="addsubject-modal" data-modal-toggle="addsubject-modal"
                class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                <svg class="w-5 h-5 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Tambah Mata Pelajaran
            </button>
            <!-- Main modal -->
            <div id="addsubject-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Tambah Mata Pelajaran
                            </h3>
                            <button type="button"
                                class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                data-modal-toggle="addsubject-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="/admin/subject" method="POST" class="p-4 md:p-5">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Mata
                                        Pelajaran</label>
                                    <input type="text" name="name" id="subject"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">
                                </div>
                                <div class="col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-800" for="idTeacher">Pilih
                                        Guru</label>
                                    <select
                                        class="bg-gray-50 border border-cyan-500 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                        name="idTeacher" id="idTeacher">
                                        <option value="">--Pilih Guru--</option>
                                        @forelse ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                                        @empty
                                            <option value="">Tidak Ada Guru</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <svg class="me-1 -ms-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                    viewBox="0 0 64 64" id="save">
                                    <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"
                                        d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                    </path>
                                    <rect width="36" height="24" x="14" y="6" fill="none" stroke="#FFFFFF"
                                        stroke-miterlimit="10" stroke-width="4"></rect>
                                    <rect width="24" height="16" x="18" y="42" fill="none" stroke="#FFFFFF"
                                        stroke-miterlimit="10" stroke-width="4"></rect>
                                    <line x1="26" x2="26" y1="48" y2="58" fill="none"
                                        stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"></line>
                                </svg>
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mata Pelajaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Enrollment Key
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Guru
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($subjects as $subject)
                            <tr class="odd:bg-white text-gray-900 border border-cyan-500 even:bg-gray-50">
                                <td class="px-6 py-1">
                                    {{ $iteration++ }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $subject->name }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $subject->enrollment_key }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $subject->teacher->first_name . ' ' . $subject->teacher->last_name }}
                                </td>
                                <td class="px-6 py-1 flex flex-items-center justify-center gap-1">
                                    <button type="button"
                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                        data-confirm-delete="true"
                                        onclick="deleteData(event, '/admin/subject/{{ $subject->id }}')">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                            <path
                                                d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                        title="edit mata pelajaran"
                                        data-modal-target="editSubject-modal-{{ $subject->id }}"
                                        data-modal-toggle="editSubject-modal-{{ $subject->id }}">
                                        <svg class="feather feather-edit w-5 h-5" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            viewBox="0 0 24 24" xmlns=" http://www.w3.org/2000/svg">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>
                                    <div id="editSubject-modal-{{ $subject->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div
                                                class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                                    <h3 class="text-lg font-semibold text-gray-900">
                                                        Edit Mata Pelajaran
                                                    </h3>
                                                    <button type="button"
                                                        class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                        data-modal-toggle="editSubject-modal-{{ $subject->id }}">
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
                                                <form action="/admin/subject/{{ $subject->id }}" method="POST"
                                                    class="p-4 md:p-5">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <div class="col-span-2">
                                                            <label for="subject"
                                                                class="block mb-2 text-sm font-medium text-start text-gray-900">Mata
                                                                Pelajaran</label>
                                                            <input type="text" name="name" id="subject"
                                                                class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 "
                                                                value="{{ $subject->name }}">
                                                        </div>
                                                        <div class="col-span-2">
                                                            <label
                                                                class="block mb-1 text-sm font-medium text-start text-gray-800"
                                                                for="idTeacher">Pilih
                                                                Guru</label>
                                                            <select
                                                                class="bg-gray-50 border border-cyan-500 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                                                name="idTeacher" id="idTeacher">
                                                                <option value="">--Pilih Guru--</option>
                                                                @forelse ($teachers as $teacher)
                                                                    <option value="{{ $teacher->id }}"
                                                                        @if ($teacher->id == $subject->idTeacher) selected @endif>
                                                                        {{ $teacher->first_name . ' ' . $teacher->last_name }}
                                                                    </option>
                                                                @empty
                                                                    <option value="">Tidak Ada Guru</option>
                                                                @endforelse
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
                                                                stroke-miterlimit="10" stroke-width="4"></line>
                                                        </svg>
                                                        Simpan
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p class="text-md text-center">Tidak Ada Siswa</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
