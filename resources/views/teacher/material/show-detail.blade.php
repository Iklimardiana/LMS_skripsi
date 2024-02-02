@extends('layouts.master')
@section('title')
    Pratinjau Materi
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div
            class="w-full flex flex-col md:flex-row p-4 gap-2 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg min-h-100">
            <div class="flex flex-col w-full">
                <div class="flex flex-col w-full border border-cyan-500 p-3 bg-cyan-50 mt-2 md:mt-0 space-y-2">
                    <a href="/teacher/materials/{{ $material->idSubject }}">
                        <svg class="w-6 h-6 mb-2 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                    </a>
                    <div class="flex flex-col min-h-80">
                        <div class="h-auto p-2 rounded-sm bg-white border border-cyan-500 mb-2">
                            <h1 class=" text-center font-medium text-3xl">{{ $material->name }}</h1>
                            <hr class="mt-2 border-cyan-500">
                            <p class="mt-2 text-justify">
                                {!! $convertedContent !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
