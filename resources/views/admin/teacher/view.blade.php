@extends('layouts.master')
@section('title')
    teacher-admin
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <button type="button"
                class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none"
                onclick="redirectToAddTeacher()">
                <svg class="w-5 h-5 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 18">
                    <path
                        d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
                </svg>
                Tambah Data Guru
            </button>
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mata Pelajaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Avatar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($teachers as $teacher)
                            <tr class="odd:bg-white text-gray-900 border border-cyan-500 even:bg-gray-50">
                                <td class="px-6 py-1">
                                    {{ $iteration++ }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $teacher->first_name . ' ' . $teacher->last_name }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $teacher->email }}
                                </td>
                                <td class="px-6 py-1">
                                    @forelse ($teacher->subject as $subject)
                                        <p>{{ $subject->name }}</p>
                                    @empty
                                        <p>Belum diset</p>
                                    @endforelse
                                </td>
                                <td class="px-6 py-1">
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/avatar/' . $teacher->avatar) }}"
                                        alt="photo profile guru">
                                </td>
                                <td class="px-6 py-1">
                                    <button type="button"
                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-3 py-2.5 focus:outline-none"
                                        data-confirm-delete="true"
                                        onclick="deleteData(event, '/admin/teacher/{{ $teacher->id }}')">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                            <path
                                                d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                        </svg>
                                    </button>
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
