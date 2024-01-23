@extends('layouts.master')
@section('title')
    List Student
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="flex items-center justify-between gap-2 mb-2">
                <a href="/teacher/subject">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
            </div>
            <div class="mb-2">
                <p class="text-center text-gray-900 font-medium text-xl">Daftar Siswa {{ $subjects->name }}</p>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                @if (!empty($students))
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Siswa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Progres
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center text-gray-900">
                            @forelse ($enrollment as $enroll)
                                <tr class="odd:bg-gray-50 even:bg-cyan-50 b border border-cyan-500">
                                    <td class="px-6 py-1">
                                        {{ $iteration++ }}
                                    </td>
                                    <td class="px-6 py-1">
                                        {{ $enroll->user->first_name . ' ' . $enroll->user->last_name }}
                                    </td>
                                    <td class="px-6 py-1">
                                        80%(masih statis)
                                    </td>
                                </tr>
                            @empty
                                <tr class="odd:bg-gray-50 even:bg-cyan-50 b border border-cyan-500">
                                    <td class="px-6 py-1">

                                    </td>
                                    <td class="px-6 py-1">
                                        Tidak ada siswa yang terdaftar pada mata pelajaran ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-900 font-medium text-lg">Tidak Ada Daftar Siswa</p>
                @endif
            </div>
        </div>
    </div>
@endsection
