@extends('layouts.master')
@section('title')
    Create Question
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="gap-2 mb-2">
                <div class="text-white font-medium text-lg">
                    <p class="text-cyan-500">Edit Soal Pada {{ $question->exam->title }}</p>
                </div>
            </div>
            <div class="sm:rounded-lg bg-cyan-50 p-4 border border-cyan-500">
                @if (session('error'))
                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (session('error'))
                                <p>{{ session('error') }}</p>
                            @endif
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-2" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                @error('answer')
                    <div id="alert-answer" class="flex items-center px-4 py-2 mb-4 text-red-800 rounded-lg bg-red-50"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ $message }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-answer" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @enderror
                @error('isCorrect')
                    <div id="alert-isCorrect" class="flex items-center px-4 py-2 mb-4 text-red-800 rounded-lg bg-red-50"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ $message }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-isCorrect" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @enderror
                @error('answer.*.answer_content')
                    <div id="alert-answerContent" class="flex items-center px-4 py-2 mb-4 text-red-800 rounded-lg bg-red-50"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ $message }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-answerContent" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @enderror
                @error('answer_content')
                    <div id="alert-answerContent-2" class="flex items-center px-4 py-2 mb-4 text-red-800 rounded-lg bg-red-50"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ $message }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-answerContent-2" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @enderror
                <form action="/exam/{{ $question->idExam }}/question/{{ $question->id }}" id="questionForm"
                    enctype="multipart/form-data" method="POST" class="md:w-3/4 w-full">
                    @method('PUT')
                    @csrf
                    <div id="questionsContainer">
                        <!-- Container untuk satu textarea soal -->
                        <div class="mb-3">
                            <label for="content" class="font-medium">Soal Nomor
                                {{ $question->count() + 1 }}</label>
                            <div class="gap-1">
                                <textarea
                                    class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500"
                                    name="content" id="editor{{ $question->idExam }}">{{ $question->content }}</textarea>
                            </div>
                            @error('content')
                                <div id="alert-questionContent"
                                    class="flex items-center px-4 py-2 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div class="ms-3 text-sm font-medium">
                                        {{ $message }}
                                    </div>
                                    <button type="button"
                                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                                        data-dismiss-target="#alert-questionContent" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </div>
                            @enderror
                        </div>
                        @foreach ($answers as $answer)
                            <div class="mb-3" id="optionContainer-{{ $answer->id }}">
                                <label for="editorOption{{ $loop->index + 1 }}" class="font-medium">Opsi
                                    {{ $loop->index + 1 }}</label>
                                <div class="flex mb-2 gap-1" id="answer-{{ $answer->id }}">
                                    <input type="radio" name="answer_content" value="{{ $loop->index + 1 }}"
                                        id="editorOption{{ $loop->index + 1 }}"
                                        @if ($answer->isCorrect == '1') checked @endif>
                                    <textarea id="editorOptionContent{{ $loop->index + 1 }}" name="answer[{{ $loop->index + 1 }}][answer_content]"
                                        class="border border-cyan-400 rounded-md p-2 w-full">{{ $answer->answer_content }}</textarea>
                                </div>
                                <button type="button"
                                    onclick="deleteData(event, '/exam/answer/{{ $answer->id }}','answer-{{ $answer->id }}')"
                                    class="text-red-500 ml-6">Hapus Opsi</button>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-start">
                        <a href="/teacher/{{ $question->idExam }}/questions/show"
                            class="flex gap-1 cursor-pointer text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            Kembali
                        </a>
                        <button type="submit"
                            class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto">
                            <svg class="me-1 -ms-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                viewBox="0 0 64 64" id="save">
                                <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"
                                    d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                </path>
                                <rect width="36" height="24" x="14" y="6" fill="none" stroke="#FFFFFF"
                                    stroke-miterlimit="10" stroke-width="4"></rect>
                                <rect width="24" height="16" x="18" y="42" fill="none" stroke="#FFFFFF"
                                    stroke-miterlimit="10" stroke-width="4"></rect>
                                <line x1="26" x2="26" y1="48" y2="58" fill="none"
                                    stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"></line>
                            </svg>
                            Perbarui
                        </button>
                        <button type="button" onclick="addOptionForm()"
                            class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto">
                            <svg class="w-5 h-5 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Tambah opsi jawaban
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector(`#editor{!! $question->idExam !!}`), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}&upload_type=question'
                },
                mediaEmbed: {
                    previewsInData: true
                }
            })
            .then(editor => {
                console.log('CKEditor initialized successfully');
            })
            .catch(error => {
                console.error(error);
            });

        let optionCount = {{ $answerCount }};
        let editorInstances = {}; // Pemetaan antara nomor opsi dan instans CKEditor
        let answerIndex = 0;

        function addOptionForm() {
            const optionsContainer = document.getElementById('questionsContainer');
            optionCount++;
            answerIndex = optionCount;

            const optionDiv = document.createElement('div');
            optionDiv.classList.add('mb-3', 'flex', 'flex-col'); // Menambahkan class flex dan flex-col
            optionDiv.id = `optionContainer${optionCount}`;

            const labelContainer = document.createElement('div'); // Container untuk label
            labelContainer.classList.add('ml-6', 'mb-2');
            const label = document.createElement('label');
            label.htmlFor = `answer${optionCount}`;
            label.className = 'font-medium';
            label.innerText = `Option ${optionCount}`;
            labelContainer.appendChild(label);
            optionDiv.appendChild(labelContainer);

            const editorRadioContainer = document.createElement('div');
            editorRadioContainer.classList.add('flex', 'mb-2', 'gap-1');

            const radio = document.createElement('input');
            radio.id = `editorOption${optionCount}`;
            radio.type = 'radio';
            radio.name = 'answer_content';
            radio.value = optionCount;

            const editorElement = document.createElement('textarea');
            editorElement.id = `editorOptionContent${optionCount}`;
            editorElement.className = 'border border-cyan-400 rounded-md p-2 w-full';
            editorElement.name = `answer[${optionCount}][answer_content]`;

            editorRadioContainer.appendChild(radio);
            editorRadioContainer.appendChild(editorElement);

            optionDiv.appendChild(editorRadioContainer);

            const deleteButtonContainer = document.createElement('div');
            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.innerText = 'Hapus Option';
            deleteButton.className = 'text-red-500 ml-6';
            deleteButton.addEventListener('click', () => removeOption(optionCount));
            deleteButtonContainer.appendChild(deleteButton);
            optionDiv.appendChild(deleteButtonContainer);

            optionsContainer.appendChild(optionDiv);

            if (editorElement) {
                ClassicEditor
                    .create(editorElement, {
                        ckfinder: {
                            uploadUrl: '{{ route('ckeditor.upload') }}?_token=' + encodeURIComponent(
                                '{{ csrf_token() }}') + '&upload_type=answer&answer_index=' + encodeURIComponent(
                                answerIndex)
                        },
                        mediaEmbed: {
                            previewsInData: true
                        }
                    })
                    .then(editor => {
                        editorInstances[optionCount] = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }

        function removeOption(optionNumber) {
            const optionsContainer = document.getElementById('questionsContainer');
            const optionDiv = document.getElementById(`optionContainer${optionNumber}`);

            if (optionDiv) {
                const editorInstance = editorInstances[optionNumber];

                if (editorInstance) {
                    editorInstance.destroy();
                    delete editorInstances[optionNumber];
                }

                optionsContainer.removeChild(optionDiv);

                for (let i = optionNumber + 1; i <= optionCount; i++) {
                    const currentOptionDiv = document.getElementById(`optionContainer${i}`);
                    const updatedOptionNumber = i - 1;

                    currentOptionDiv.id = `optionContainer${updatedOptionNumber}`;
                    currentOptionDiv.querySelector('label').innerText = `Option${updatedOptionNumber}`;

                    editorInstances[updatedOptionNumber] = editorInstances[i];
                    delete editorInstances[i];
                }

                optionCount--;
            } else {
                console.error(`Option Container dengan ID 'optionContainer${optionNumber}'tidak ditemukan.`);
            }
        }

        var answerConfigs = [];
        @foreach ($answers as $answer)
            answerConfigs.push({
                editorId: `editorOptionContent{{ $loop->index + 1 }}`,
                ckfinderUploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}&upload_type=answer&answer_index={{ $loop->index + 1 }}',
                mediaEmbedPreviewsInData: true,
                answerId: {{ $answer->id }}
            });
        @endforeach

        answerConfigs.forEach(config => {
            ClassicEditor
                .create(document.querySelector(`#${config.editorId}`), {
                    ckfinder: {
                        uploadUrl: config.ckfinderUploadUrl
                    },
                })
                .then(editor => {
                    console.log(`CKEditor initialized successfully for ${config.editorId}`);
                    const answerId = config.answerId;
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush
