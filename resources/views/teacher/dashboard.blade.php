@extends('layouts.master')
@section('title')
    Dahboard Teacher
@endsection
@section('content')
    <div class="p-4 mt-20 sm:ml-72 sm:mr-9">
        <div class="py-4 px-7 border-2 border-gray-200 h-auto border-dashed mb-20 rounded-lg ">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-row items-center space-x-2 min-h-40 p-3 justify-start rounded bg-cyan-200">
                    <svg class="sm:w-20 sm:h-20 w-16 h-16" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <path class="fill-current text-gray-600"
                                d="M505.837,180.418L279.265,76.124c-7.349-3.385-15.177-5.093-23.265-5.093c-8.088,0-15.914,1.708-23.265,5.093 L6.163,180.418C2.418,182.149,0,185.922,0,190.045s2.418,7.896,6.163,9.627l226.572,104.294c7.349,3.385,15.177,5.101,23.265,5.101 c8.088,0,15.916-1.716,23.267-5.101l178.812-82.306v82.881c-7.096,0.8-12.63,6.84-12.63,14.138c0,6.359,4.208,11.864,10.206,13.618 l-12.092,79.791h55.676l-12.09-79.791c5.996-1.754,10.204-7.259,10.204-13.618c0-7.298-5.534-13.338-12.63-14.138v-95.148 l21.116-9.721c3.744-1.731,6.163-5.504,6.163-9.627S509.582,182.149,505.837,180.418z" />
                            <path class="fill-current text-gray-500"
                                d="M256,346.831c-11.246,0-22.143-2.391-32.386-7.104L112.793,288.71v101.638 c0,22.314,67.426,50.621,143.207,50.621c75.782,0,143.209-28.308,143.209-50.621V288.71l-110.827,51.017 C278.145,344.44,267.25,346.831,256,346.831z" />
                        </g>
                    </svg>
                    <div class="flex flex-col">
                        <p class="text-4xl font-semibold text-gray-600 ">
                            {{ $totalStudents }}
                        </p>
                        <span class="text-xl font-normal text-gray-600">
                            siswa
                        </span>
                    </div>
                    {{-- <span class="mb-2">
                            <p>
                                Jumlah Siswa
                            </p>
                        </span>
                    </div> --}}
                    {{-- <div class="w-full mx-5 relative overflow-x-auto">
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
                    </div> --}}
                </div>
                <div class="flex flex-row items-center h-auto p-3 justify-start rounded bg-cyan-200">
                    <svg class="flex-shrink-0 sm:w-16 sm:h-16 w-14 h-14 text-gray-500 transition duration-75 group-hover:text-gray-900 "
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path
                            d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                    </svg>
                    <div class="flex flex-col">
                        <p class="text-4xl font-semibold text-gray-600 ">
                            {{ $subjectCount }}
                        </p>
                        <span class="text-xl font-normal text-gray-600">
                            Mata Pelajaran
                        </span>
                    </div>
                    {{-- <div class="w-full  mx-5 sm:rounded-lg">
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
