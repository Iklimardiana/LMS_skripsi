@extends('layouts.master')
@section('title')
    Create Question
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="gap-2 mb-2">
                <div class="text-white font-medium text-lg">
                    <p class="text-cyan-500">Tambah Soal Pada {{ $exam->title }}</p>
                </div>
            </div>
            <div class="sm:rounded-lg bg-cyan-50 p-4 border border-cyan-500">
                @error('content')
                    {{ $message }}
                @enderror
                @error('answer')
                    {{ $message }}
                @enderror
                @error('isCorrect')
                    {{ $message }}
                @enderror
                @error('answer.*.answer_content')
                    {{ $message }}
                @enderror
                @error('answer_content')
                    {{ $message }}
                @enderror
                <form action="/teacher/question/{{ $exam->id }}" id="questionForm" enctype="multipart/form-data"
                    method="POST" class="md:w-3/4 w-full">
                    @csrf
                    <div id="questionsContainer">
                        <!-- Container untuk satu textarea soal -->
                        <div class="mb-3">
                            <label for="content" class="font-medium">Soal Nomor {{ $exam->question->count() + 1 }}</label>
                            <div class="gap-1">
                                <textarea
                                    class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500"
                                    name="content" id="editor{{ $exam->id }}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start">
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
                            Simpan
                        </button>
                        <button type="button" onclick="addOptionForm()"
                            class="flex text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md text-sm p-2 me-2 focus:outline-none mt-3 w-auto">
                            <svg class="w-5 h-5 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
            .create(document.querySelector(`#editor{!! $exam->id !!}`), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
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

        let optionCount = 0;
        let editorInstances = {}; // Pemetaan antara nomor opsi dan instans CKEditor
        function addOptionForm() {
            const optionsContainer = document.getElementById('questionsContainer');
            optionCount++;

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
            editorElement.name = `answer[${optionCount}][answer_content]`

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
                            uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                        },
                        mediaEmbed: {
                            previewsInData: true
                        }
                    })
                    .then(editor => {
                        console.log('CKEditor berhasil diinisialisasi');
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
    </script>
@endpush
