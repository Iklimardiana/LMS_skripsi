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
                <form action="/teacher/subject/{{ $subject->id }}/student" class="w-1/2">
                    <div class="flex">
                        <div class="relative w-full">
                            <input type="search" name="keyword" value="{{ request('keyword') }}"
                                class="block rounded-l-md p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-cyan-300 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Cari nama...">
                            <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-cyan-500 rounded-e-lg border border-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-cyan-300">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                @if ($students->count())
                    <div class="mb-2">
                        <p class="text-center text-gray-900 font-medium text-xl">Daftar Siswa {{ $subject->name }}</p>
                    </div>
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
                                        @php
                                            $progresUser = $progres->where('idUser', $enroll->idUser)->first();
                                        @endphp
                                        @if ($progresUser ? $progresUser->sequence : '')
                                            @if ($progresUser->sequence == $subject->Material->count())
                                                @if ($progresUser->status == 0)
                                                    {{ round(($progresUser->sequence / $subject->Material->count()) * 100) - 1 }}
                                                    %
                                                @else
                                                    Complete (100%)
                                                @endif
                                            @else
                                                @if ($progresUser->status == 0)
                                                    {{ round(($progresUser->sequence / $subject->Material->count()) * 100) - 1 }}
                                                    %
                                                @else
                                                    {{ round(($progresUser->sequence / $subject->Material->count()) * 100) }}
                                                    %
                                                @endif
                                            @endif
                                        @else
                                            0%
                                        @endif
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
                    <p class="text-center text-gray-900 font-medium text-lg">Daftar siswa tidak ditemukan</p>
                @endif
            </div>
            <div class="mt-3">
                {{ $enrollment->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
