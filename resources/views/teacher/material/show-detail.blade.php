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
                    <div class="flex flex-col min-h-80">
                        <div class="h-auto p-2 rounded-sm bg-white border border-cyan-500 mb-2">
                            <h1 class=" text-center font-medium text-3xl">{{ $materials->name }}</h1>
                            <hr class="mt-2 border-cyan-500">
                            <p class="mt-2 text-justify">
                                {{ $materials->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
