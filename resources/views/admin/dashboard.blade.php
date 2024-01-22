@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="flex flex-col items-center h-auto p-3 justify-items-center rounded bg-cyan-50">
                    <p class="text-2xl font-semibold text-gray-900 ">
                        {{ $teacherCount }}
                    </p>
                    <span class="mb-2">
                        <p>
                            Jumlah Guru
                        </p>
                    </span>
                    <div class="w-full mx-5 relative overflow-x-auto">
                        <a href="#">
                            <table
                                class="w-full text-sm text-left rtl:text-right border border-cyan-500 shadow-sm text-gray-500 ">
                                <thead class="text-xs text-white text-center uppercase bg-cyan-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Daftar Guru
                                        </th>
                                    </tr>
                                </thead>
                                @forelse ($teachers as $teacher)
                                    <tbody class="text-center">
                                        <tr class="bg-white border-b border-cyan-500 hover:bg-gray-50 ">
                                            <td class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $teacher->first_name . ' ' . $teacher->last_name }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <p class="text-md text-center">Tidak Ada Guru</p>
                                @endforelse
                            </table>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col items-center h-auto p-3 justify-items-start rounded bg-cyan-50">
                    <p class="text-2xl font-semibold text-gray-900 ">
                        {{ $studentCount }}
                    </p>
                    <span class="mb-2">
                        <p>
                            Jumlah Siswa
                        </p>
                    </span>
                    <div class="w-full mx-5 relative overflow-x-auto">
                        <a href="#">
                            <table
                                class="w-full text-sm text-left rtl:text-right border border-cyan-500 shadow-sm text-gray-500 ">
                                <thead class="text-xs text-white text-center uppercase bg-cyan-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Daftar Siswa
                                        </th>
                                    </tr>
                                </thead>
                                @forelse ($students as $student)
                                    <tbody class="text-center">
                                        <tr class="bg-white border-b border-cyan-500 hover:bg-gray-50 ">
                                            <td class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $student->first_name . ' ' . $student->last_name }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <p class="text-md text-center">Tidak Ada Siswa</p>
                                @endforelse
                            </table>
                        </a>
                    </div>
                </div>
                <div class="flex flex-col items-center h-auto p-3 justify-items-start rounded bg-cyan-50">
                    <p class="text-2xl font-semibold text-gray-900 ">
                        {{ $subjectCount }}
                    </p>
                    <span class="mb-2">
                        <p>
                            Jumlah Mata Pelajaran
                        </p>
                    </span>
                    <div class="w-full mx-5 relative overflow-x-auto">
                        <a href="#">
                            <table
                                class="w-full text-sm text-left rtl:text-right border border-cyan-500 shadow-sm text-gray-500 ">
                                <thead class="text-xs text-white text-center uppercase bg-cyan-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Daftar Mata Pelajaran
                                        </th>
                                    </tr>
                                </thead>
                                @forelse ($subjects as $subject)
                                    <tbody class="text-center">
                                        <tr class="bg-white border-b border-cyan-500 hover:bg-gray-50 ">
                                            <td class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $subject->name }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <p class="text-md text-center">Tidak Ada Mata Pelajaran</p>
                                @endforelse
                            </table>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
