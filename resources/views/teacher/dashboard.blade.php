@extends('layouts.master')
@section('title')
    Dahboard Teacher
@endsection
@section('content')
    <div class="p-4 mt-20 sm:ml-72 sm:mr-9">
        <div class="py-4 px-7 border-2 border-gray-200 h-auto border-dashed mb-20 rounded-lg ">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="min-h-24 max-h-96 p-3 flex flex-col items-center justify-center rounded bg-cyan-100">
                    <p class="text-4xl font-semibold text-gray-600 ">
                        {{ $totalStudents }}
                    </p>
                    <span class="text-xl font-normal text-gray-600">
                        siswa
                    </span>
                    <div class="w-full mx-5 relative overflow-x-auto">
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
                                                    {{ $individualStudent->first_name . ' ' . $individualStudent->last_name }}
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
                    </div>
                </div>
                <div class="flex flex-col items-center min-h-24 max-h-96 h-auto p-3 justify-center rounded bg-cyan-100">
                    <p class="text-4xl font-semibold text-gray-600 ">
                        {{ $subjectCount }}
                    </p>
                    <span class="text-xl font-normal text-gray-600">
                        Mata Pelajaran
                    </span>
                    <div class="w-full mx-5 relative overflow-x-auto">
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
