@extends('layouts.master')
@section('title')
    Tambah Tugas
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="gap-2 mb-2">
                <div class="text-white font-medium text-lg">
                    <p class="text-cyan-500">Tambah Tugas Pada Materi {{ $materials->name }}</p>
                </div>
            </div>
            <div class="sm:rounded-lg bg-cyan-50 p-4 border border-cyan-500">
                <form action="/teacher/assignment/{{ $materials->id }}" method="post" enctype="multipart/form-data"
                    class="md:w-1/2 w-full">
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
                    @error('attachment')
                        <div id="alert-3" class="flex items-center px-4 py-3 mb-4 text-red-800 rounded-lg bg-red-50"
                            role="alert">
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
                    <div class="mt-5 mb-3" id="pdfForm" style="display: none;">
                        <label for="file" class="font-medium">Assignment</label>
                        <input type="file" id="file" name="attachment"
                            class="block text-sm text-gray-900 border border-cyan-400 rounded-md cursor-pointer bg-gray-50 focus:outline-none file:bg-cyan-500 w-full"
                            aria-describedby="file_input_help">
                    </div>
                    <div class="mt-5 mb-3 flex flex-col" id="linkForm" style="display: none;">
                        <label for="link" class="font-medium">Assignment</label>
                        <input type="url" id="link" name="attachment"
                            class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                    <div class="flex justify-start">
                        <button type="button"
                            class="flex gap-1 text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto"
                            onclick="redirectToMaterial({{ $materials->idSubject }}, '{{ Auth::user()->role }}')">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            Kembali
                        </button>
                        <button type="submit"
                            class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto">
                            <svg class="me-1 -ms-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                viewBox="0 0 64 64" id="save">
                                <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"
                                    d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                </path>
                                <rect width="36" height="24" x="14" y="6" fill="none" stroke="#FFFFFF"
                                    stroke-miterlimit="10" stroke-width="4">
                                </rect>
                                <rect width="24" height="16" x="18" y="42" fill="none" stroke="#FFFFFF"
                                    stroke-miterlimit="10" stroke-width="4">
                                </rect>
                                <line x1="26" x2="26" y1="48" y2="58" fill="none"
                                    stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"></line>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const categoryInput = document.querySelector('#type');
        const linkForm = document.querySelector('#linkForm');
        const pdfForm = document.querySelector('#pdfForm');

        categoryInput.addEventListener('change', function() {
            if (this.value === '') {
                pdfForm.style.display = 'none';
                linkForm.style.display = 'none';
            }
            if (this.value === 'file') {
                pdfForm.style.display = 'block';
                linkForm.style.display = 'none';
            }
            if (this.value === 'link') {
                linkForm.style.display = 'block';
                pdfForm.style.display = 'none';

            }
        });
    </script>
    <script>
        function redirectToMaterial(idSubject, userRole) {
            if (userRole === 'student') {
                var baseUrl = '/student/materials/';
            } else if (userRole === 'teacher') {
                var baseUrl = '/teacher/materials/';
            }
            var materialUrl = baseUrl + idSubject;
            window.location.href = materialUrl;
        }
    </script>
@endsection
