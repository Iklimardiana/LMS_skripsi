@extends('layouts.master')
@section('title')
    Forum Diskusi
@endsection
@section('content')
    <div class="mb-2 border-b border-cyan-200 md:ml-64 lg:ml-64">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 text-cyan-500 rounded-t-lg hover:text-cyan-600 hover:border-cyan-300"
                    id="enrolled-tab" data-tabs-target="#enrolled" type="button" role="tab" aria-controls="enrolled"
                    aria-selected="false">Terdaftar</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg text-cyan-500  hover:text-cyan-600 hover:border-cyan-300"
                    id="unenrolled-tab" data-tabs-target="#unenrolled" type="button" role="tab"
                    aria-controls="unenrolled" aria-selected="false">Tidak Terdaftar</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content" class="md:ml-64 lg:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col h-auto justify-between items-center rounded-lg bg-cyan-50 border border-cyan-500">
                    <img class="w-full rounded-t-lg h-40 object-cover" src="../images/thumbnailDefault.jpg"
                        alt="image description">
                    <div class="flex lg:flex-row flex-col items-center justify-between w-full mx-5 p-3 text-gray-900">
                        <span class="font-semibold text-lg md:text-2xl md:text-center">INFORMATIKA X-1</span>
                        <span class="font-light text-end">
                            Guru ABDSAAS JSA
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-y-1 items-end justify-center w-full mx-5 p-3 text-gray-900">
                        <button type="button" onclick="redirectToStudent()"
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
                        <button type="button" onclick="redirectSetting()" data-modal-target="setting-modal"
                            data-modal-toggle="setting-modal"
                            class=" text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm md:w-20 w-auto px-1 py-1 md:py-2 me-2 focus:outline-none  ">
                            Pengaturan
                        </button>
                    </div>
                </div>
                <div class="flex flex-col h-auto justify-between items-center rounded-lg bg-cyan-50 border border-cyan-500">
                    <img class="w-full rounded-t-lg h-40 object-cover" src="../images/thumbnailDefault.jpg"
                        alt="image description">
                    <div class="flex lg:flex-row flex-col items-center justify-between w-full mx-5 p-3 text-gray-900">
                        <span class="font-semibold text-lg md:text-2xl md:text-center">INFORMATIKA X-2</span>
                        <span class="font-light text-end">
                            Guru ABDSAAS JSA
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-y-1 items-end justify-center w-full mx-5 p-3 text-gray-900">
                        <button type="button" onclick="redirectToStudent()"
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
                        <button type="button" data-modal-target="setting-modal" data-modal-toggle="setting-modal"
                            class=" text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm md:w-20 w-auto px-1 py-1 md:py-2 me-2 focus:outline-none  ">
                            Pengaturan
                        </button>
                    </div>
                </div>
            </div>
            <!-- Main modal -->
            <div id="setting-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Membuat Enrollment-Key
                            </h3>
                            <button type="button"
                                class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                data-modal-toggle="setting-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="subject"
                                        class="block mb-2 text-sm font-medium text-gray-900">Enrollment-Key</label>
                                    <input type="text" name="subject" id="subject"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 "
                                        required="">
                                </div>
                            </div>
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi
                                        Enrollment-Key</label>
                                    <input type="text" name="subject" id="subject"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 "
                                        required="">
                                </div>
                            </div>
                            <div class="flex items-center justify-start space-x-3">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal -->
        </div>
    </div>
@endsection
