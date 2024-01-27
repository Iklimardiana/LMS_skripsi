@extends('layouts.master')
@section('title')
    Edit Assignment
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="gap-2 mb-2">
                <div class="text-white font-medium text-lg">
                    <p class="text-cyan-500">Tambah Tugas Pada Materi A</p>
                </div>
            </div>
            <div class="sm:rounded-lg bg-cyan-50 p-4 border border-cyan-500">
                <form class="md:w-1/2 w-full">
                    <div class="h-auto text-sm text-left text-gray-900">
                        <label for="idUser" class="font-medium">Tipe Tugas</label>
                        <select
                            class="relative mt-2 bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg block p-2.5 w-full"
                            name="category" id="category">
                            <option value="">--Pilih Tipe Tugas--</option>
                            <option value="0">Upload Pdf</option>
                            <option value="1">Insert link</option>
                        </select>
                    </div>
                    <div class="mt-5 mb-3" id="pdfForm" style="display: none;">
                        <label for="pdfFile" class="font-medium">Assignment</label>
                        <input type="file" id="pdfFile" name="pdfFile"
                            class="block text-sm text-gray-900 border border-cyan-400 rounded-md cursor-pointer bg-gray-50 focus:outline-none file:bg-cyan-500 w-full"
                            aria-describedby="file_input_help">
                    </div>
                    <div class="mt-5 mb-3 flex flex-col" id="linkForm" style="display: none;">
                        <label for="link" class="font-medium">Assignment</label>
                        <input type="url" id="link" name="link"
                            class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2">
                    </div>
                    <div class="flex justify-start">
                        <button type="button"
                            class="flex gap-1 text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto"
                            onclick="redirectListMaterials()">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            Kembali
                        </button>
                        <button type="submit"
                            class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto"
                            onclick="redirectToAddTeacher()">
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
                            Update
                        </button>
                        <button type="submit"
                            class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
