@extends('layouts.master')
@section('title')
    Daftar Materi
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            @error('attachment')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="flex items-center justify-between gap-2 mb-2">
                <a href="/teacher/subject">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
                <button type="button" onclick="redirectToAddMaterial({{ $subjects->id }})"
                    class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 focus:outline-none"
                    title="Klik untuk menambah materi">
                    <svg class="w-5 h-5 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Tambah Materi
                </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                        <tr>
                            <th scope="col" class="px-6 py-3 border border-cyan-50">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3 border border-cyan-50">
                                Judul Materi
                            </th>
                            <th scope="col" class="px-6 py-3 border border-cyan-50">
                                Urutan Ke-
                            </th>
                            <th scope="col" class="px-6 py-3 border border-cyan-50">
                                Aksi Materi
                            </th>
                            <th scope="col" class="px-6 py-3 border border-cyan-50">
                                Tugas
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($materials as $material)
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    {{ $iteration++ }}
                                </td>
                                <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    {{ $material->name }}
                                </td>
                                <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    {{ $material->sequence }}
                                </td>
                                <td class="px-6 py-2 flex flex-items-center justify-center gap-1">
                                    <form action="/teacher/materials/{{ $material->id }}"method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="klik untuk menghapus materi">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <button type="button"
                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                        title="Klik untuk pratinjau materi">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 14">
                                            <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2">
                                                <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                        title="Klik untuk edit materi"
                                        onclick="redirectToEditMaterial({{ $material->id }})">
                                        <svg class="feather feather-edit w-5 h-5" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            viewBox="0 0 24 24" xmlns=" http://www.w3.org/2000/svg">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    @php
                                        // $currentAttachment = $assignment->where('idMaterial', $material->id)->first();
                                        $currentAttachment = $assignment
                                            ->where('idMaterial', $material->id)
                                            ->where('category', 'fromteacher')
                                            ->first();
                                    @endphp
                                    @if ($currentAttachment)
                                        <button type="button"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Klik untuk edit tugas">
                                            <svg class="feather feather-edit w-5 h-5" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" xmlns=" http://www.w3.org/2000/svg">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                            title="Klik Untuk Pratinjau Tugas">
                                            <svg class=" w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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
                                            title="daftar tugas unggahan siswa"
                                            onclick="redirectToAttachmentStudent({{ $material->id }})">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 16 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M4.828 10h6.239m-6.239 4h6.239M6 1v4a1 1 0 0 1-1 1H1m14-4v16a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2Z" />
                                            </svg>
                                        </button>
                                    @else
                                        <button data-modal-target="addAssignment-modal"
                                            data-modal-toggle="addAssignment-modal"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none">
                                            Tambah Tugas
                                        </button>
                                        <div id="addAssignment-modal" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <!-- Modal content -->
                                                <div
                                                    class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                                        <h3 class="absolute text-lg w-auto font-semibold text-gray-900">
                                                            Tambah Tugas
                                                        </h3>
                                                        <button type="button"
                                                            class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                            data-modal-toggle="addAssignment-modal">
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
                                                        <form action="/teacher/assignment/{{ $material->id }}"
                                                            enctype="multipart/form-data" method="POST"
                                                            class="p-4 md:p-5">
                                                            @csrf
                                                            <div class="h-auto text-sm text-left text-gray-900">
                                                                <label for="type" class="font-medium">Tipe
                                                                    Tugas</label>
                                                                <select
                                                                    class="relative mt-2 bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg block p-2.5 w-full focus:ring-cyan-500 focus:border-cyan-500"
                                                                    name="type" id="type">
                                                                    <option value="">--Pilih Tipe Tugas--</option>
                                                                    <option value="file">Upload Pdf</option>
                                                                    <option value="link">Tautan/ Link</option>
                                                                </select>
                                                            </div>
                                                            <div class="mt-5 mb-3" id="pdfForm" style="display: none;">
                                                                <label for="file"
                                                                    class="font-medium">Assignment</label>
                                                                <input type="file" id="file" name="attachment"
                                                                    class="block text-sm text-gray-900 border border-cyan-400 rounded-md cursor-pointer bg-gray-50 focus:outline-none file:bg-cyan-500 w-full"
                                                                    aria-describedby="file_input_help">
                                                            </div>
                                                            <div class="mt-5 mb-3 flex flex-col" id="linkForm"
                                                                style="display: none;">
                                                                <label for="link"
                                                                    class="font-medium">Assignment</label>
                                                                <input type="url" id="link" name="attachment"
                                                                    class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500">
                                                            </div>
                                                            <div class="flex justify-start">
                                                                <button type="button"
                                                                    class="flex gap-1 text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto"
                                                                    onclick="redirectListMaterials()">
                                                                    <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 14 10">
                                                                        <path stroke="currentColor" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                                                                    </svg>
                                                                    Kembali
                                                                </button>
                                                                <button type="submit"
                                                                    class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto">
                                                                    <svg class="me-1 -ms-1 w-5 h-5"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        data-name="Layer 1" viewBox="0 0 64 64"
                                                                        id="save">
                                                                        <path fill="none" stroke="#FFFFFF"
                                                                            stroke-miterlimit="10" stroke-width="4"
                                                                            d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                                                        </path>
                                                                        <rect width="36" height="24" x="14" y="6"
                                                                            fill="none" stroke="#FFFFFF"
                                                                            stroke-miterlimit="10" stroke-width="4">
                                                                        </rect>
                                                                        <rect width="24" height="16" x="18" y="42"
                                                                            fill="none" stroke="#FFFFFF"
                                                                            stroke-miterlimit="10" stroke-width="4">
                                                                        </rect>
                                                                        <line x1="26" x2="26"
                                                                            y1="48" y2="58" fill="none"
                                                                            stroke="#FFFFFF" stroke-miterlimit="10"
                                                                            stroke-width="4"></line>
                                                                    </svg>
                                                                    Simpan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    Belum Ada Materi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
