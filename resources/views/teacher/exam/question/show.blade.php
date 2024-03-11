@extends('layouts.master')
@section('title')
    Preview Question
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="w-8">
                <a href="/teacher/exam/{{ $exam->idSubject }}">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
            </div>
            <div class="flex flex-col gap-2">
                @forelse ($questions as $question)
                    <div id="question-{{ $question->id }}')"
                        class="flex flex-row justify-between gap-2 bg-cyan-50 p-3 rounded-md text-gray-900">
                        <div class="flex flex-col max-w-3xl">
                            <div class="flex justify-start">
                                <div>
                                    {{ $loop->iteration . '.' }}&nbsp;
                                </div>
                                <div class="border-b border-cyan-500 min-w-96 mb-2 pb-2" id="question-{{ $question->id }}">
                                    {!! $question->content !!}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 text-justify ml-4">
                                @forelse ($question->answer as $answer)
                                    @if ($answer->isCorrect == '1')
                                        <div class="flex justify-start  text-green-500 font-medium bg-green-100 p-1">
                                            <div>
                                                {{ chr(64 + $loop->iteration) }}.&nbsp;
                                            </div>
                                            <div class="flex flex-col">
                                                {!! $answer->answer_content !!}
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-start">
                                            <div>
                                                {{ chr(64 + $loop->iteration) }}.&nbsp;
                                            </div>
                                            <div class="flex flex-col">
                                                {!! $answer->answer_content !!}
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    Tidak ada jawaban
                                @endforelse
                            </div>
                        </div>
                        <div class="inline">
                            <div class="flex gap-1">
                                <button type="button" title="Hapus soal"
                                    onclick="deleteData(event, '/exam/question/{{ $question->id }}','question-{{ $question->id }}')"
                                    class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                    </svg>
                                </button>
                                <button type="button" onclick="redirectToEditQuestion({{ $question->id }})"
                                    class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                    title="Klik untuk edit soal">
                                    <svg class="feather feather-edit w-5 h-5" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        xmlns=" http://www.w3.org/2000/svg">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    Tidak ada pertanyaan
                @endforelse
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function redirectToEditQuestion(idQuestion) {
            var baseUrl = '/teacher/question/';
            var editQuestionUrl = baseUrl + idQuestion + '/edit';
            window.location.href = editQuestionUrl;
        }
    </script>
@endpush
