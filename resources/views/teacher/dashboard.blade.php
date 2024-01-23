@extends('layouts.master')
@section('title')
    Dahboard Teacher
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col items-center h-auto p-3 justify-items-center rounded bg-cyan-50">
                    <p class="text-2xl font-semibold text-gray-900 ">
                        {{ $totalStudents }}
                    </p>
                    <span class="mb-2">
                        <p>
                            Jumlah Siswa
                        </p>
                    </span>
                    <div class="w-full mx-5 relative overflow-x-auto">
                        <a href="/teacher/student">
                            <table
                                class="w-full text-sm text-left rtl:text-right border border-cyan-500 shadow-sm text-gray-900 ">
                                <thead class="text-xs text-white text-center uppercase bg-cyan-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Daftar Siswa
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($students as $subjectName => $subjectStudents)
                                        @foreach ($subjectStudents as $student)
                                            <tr class="bg-white border-b border-cyan-500 hover:bg-gray-50">
                                                <td class="px-6 py-1 font-normal text-gray-900 whitespace-nowrap">
                                                    @foreach ($student as $individualStudent)
                                                        {{ $individualStudent->first_name }}
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="1" class="px-6 py-1 text-gray-900 whitespace-nowrap">Tidak ada
                                                siswa yang terdaftar</td>
                                        </tr>
                                    @endforelse
                                </tbody>
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
                    <div class="w-full  mx-5 sm:rounded-lg">
                        <a href="/teacher/subject">
                            <table
                                class="w-full text-sm text-left rtl:text-right border border-cyan-500 shadow-sm text-gray-900 ">
                                <thead class="text-xs text-white text-center uppercase bg-cyan-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Daftar Mata Pelajaran
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($subjects as $subject)
                                        <tr class="bg-white border-b border-cyan-500 hover:bg-gray-50">
                                            <td class="px-6 py-1 font-normal text-gray-900 whitespace-nowrap">
                                                {{ $subject->name }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="bg-white border-b border-cyan-500 hover:bg-gray-50">
                                            <td class="px-6 py-1 font-normal text-gray-900 whitespace-nowrap">
                                                <p class="text-md text-center">Tidak ada mata pelajaran</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
