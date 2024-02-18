@extends('layouts.master')
@section('title')
    Exam List-student
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <form action="/student/exam/{{ $subject->id }}" class="w-full mb-3">
            <div class="flex">
                <div class="relative w-full">
                    <input type="search" name="keyword" value="{{ request('keyword') }}"
                        class="block rounded-l-md p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-cyan-300 focus:ring-cyan-500 focus:border-cyan-500"
                        placeholder="Cari Judul atau jenis ujian...">
                    <button type="submit"
                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-cyan-500 rounded-e-lg border border-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-cyan-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>
        <div class="flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg">
            <div class="w-7">
                <a href="/student/subject">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
            </div>
            @unless ($exams->where('status', '1')->isNotEmpty())
                <p class="text-gray-900 text-center font-medium">Ujian Tidak Ditemukan</p>
            @else
                @forelse ($exams as $exam)
                    @if ($exam->status == '1')
                        <div
                            class="flex items-center justify-between h-36 pr-2 md:pr-3 py-0 pl-0 justify-items-center rounded-lg bg-cyan-50 border border-cyan-500">
                            <div>
                                <img class="rounded-l-lg w-28 md:w-80 h-36 border-y border-cyan-500 object-cover"
                                    src="{{ asset('images/thumbnail/thumbnailDefault.jpg') }}" alt="Subject Image">
                            </div>
                            <div class="text-center text-gray-900">
                                <p class="font-semibold text text-xl md:text-2xl m-3">{{ $exam->title }}</p>
                                <p class="underline">{{ $exam->type }} | {{ $exam->duration }} menit</p>
                            </div>
                            <div class="flex flex-col space-y-2 items-center justify-end">
                                <button type="button" onclick="redirectToBeginExam()"
                                    class=" text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                    Mulai
                                </button>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-gray-900 text-center">Ujian Tidak Ditemukan</p>
                @endforelse
            @endunless
        </div>
    </div>
@endsection
