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
                <button type="button"
                    class="flex gap-1 text-cyan-500 font-medium rounded-md text-sm me-2 focus:outline-none w-auto">
                    <svg class="w-5 h-5 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </button>
                <form id="questionForm" enctype="multipart/form-data" method="POST" class="md:w-3/4 w-full">
                    @csrf
                    <div class="mt-1 mb-3" id="">
                        {{-- <label for="content" class="font-medium"> Soal 1</label>
                        <div class="gap-1">
                            <textarea
                                class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500"
                                name="content" id="editor{{ $exam->id }}-1"></textarea>
                            <button type="button" onclick="removeOption(1)" class="text-red-500">Hapus soal</button>
                        </div> --}}
                        @error('content')
                            <div id="alert-2" class="flex items-center px-4 py-1 mb-4 text-red-800 rounded-lg bg-red-50"
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
                            </div>
                        @enderror
                    </div>
                    <div id="questionsContainer">
                        <!-- Container untuk semua pertanyaan -->
                    </div>
                    <button type="button" onclick="addQuestion({{ $exam->id }})" class="text-cyan-500 mt-2">Tambah
                        Soal</button>

                    {{-- <div class="flex justify-start">
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
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let optionCount = 1;
        let questionCount = 0;

        function addOption(questionNumber) {
            optionCount++;
            const optionContent = document.querySelector(`#editorOption${questionNumber}-${optionCount}`).getData();

            // Menambahkan logika AJAX
            $.ajax({
                url: '/teacher/option/' + questionNumber,
                method: 'POST',
                data: {
                    content: optionContent,
                    // tambahkan data lainnya sesuai kebutuhan
                },
                success: function(response) {
                    // Logika setelah opsi berhasil disimpan
                    console.log(response);
                },
                error: function(error) {
                    // Logika jika ada kesalahan
                    console.error(error);
                }
            });
            const optionsContainer = document.getElementById(`optionsContainer${questionNumber}`);
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('mb-3');
            optionDiv.id = `optionContainer${questionNumber}-${optionCount}`;

            const label = document.createElement('label');
            label.htmlFor = `option${optionCount}`;
            label.className = 'font-medium';
            label.innerText = `Option ${optionCount}`;
            optionDiv.appendChild(label);

            const inputContainer = document.createElement('div');
            inputContainer.classList.add('mb-3', 'gap-1');

            const input = document.createElement('input');
            input.id = `editorOption${questionNumber}-${optionCount}`;
            input.type = 'text';
            input.name = `options[${questionNumber}][]`;
            input.className = 'border border-cyan-400 rounded-md p-2 w-full';
            inputContainer.appendChild(input);

            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.innerText = 'Hapus Option';
            deleteButton.className = 'text-red-500';
            deleteButton.addEventListener('click', () => removeOption(optionCount));
            inputContainer.appendChild(deleteButton);

            optionDiv.appendChild(inputContainer);
            optionsContainer.appendChild(optionDiv);

            ClassicEditor
                .create(document.querySelector(`#editorOption${questionNumber}-${optionCount}`), {
                    ckfinder: {
                        uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                    },
                    mediaEmbed: {
                        previewsInData: true
                    }
                })
                .then(editor => {
                    // console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function addQuestion(examId) {
            document.addEventListener('DOMContentLoaded', function() {
                // Tempatkan skrip Anda di sini
            });
            questionCount++;
            optionCount = 0;

            const questionsContainer = document.getElementById('questionsContainer');
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('mb-3');
            questionDiv.id = `questionContainer${examId}-${questionCount}`;

            const label = document.createElement('label');
            label.htmlFor = `editor-${questionCount}`;
            label.className = 'font-medium';
            label.innerText = `Soal ${questionCount}`;
            questionDiv.appendChild(label);

            const flexContainer = document.createElement('div');
            flexContainer.classList.add('gap-1');

            const textarea = document.createElement('textarea');
            textarea.id = `editor${examId}-${questionCount}`;
            textarea.className =
                'flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500';
            textarea.name = 'content'; // corrected line
            flexContainer.appendChild(textarea);

            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.innerText = 'Hapus Soal';
            deleteButton.className = 'text-red-500';
            deleteButton.addEventListener('click', () => removeQuestion(examId, questionCount));
            deleteButton.classList.add('mb-2');
            flexContainer.appendChild(deleteButton);

            questionDiv.appendChild(flexContainer);

            const optionsDiv = document.createElement('div');
            optionsDiv.id = `optionsContainer${examId}-${questionCount}`;

            const addOptionButton = document.createElement('button');
            addOptionButton.type = 'button';
            addOptionButton.innerText = 'Tambah Option';
            addOptionButton.className = 'text-cyan-500 mt-2';
            addOptionButton.addEventListener('click', () => addOption(examId, questionCount));

            questionDiv.appendChild(optionsDiv);
            questionDiv.appendChild(addOptionButton);
            questionsContainer.appendChild(questionDiv);

            // Ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Menambahkan logika AJAX
            $.ajax({
                url: '/teacher/question/' + examId,
                method: 'POST',
                data: {
                    content: $(textarea).val()
                },
                success: function(response) {
                    // Logika setelah pertanyaan berhasil disimpan
                    console.log('AJAX Success - Response:', response);
                    console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
                },
                error: function(error) {
                    // Logika jika ada kesalahan
                    console.error('AJAX Error - Error:', error);
                }
            });
        }

        // Create CKEditor instance
        // ClassicEditor
        //     .create(document.querySelector(`#editor${examId}-${questionCount}`), {
        //         ckfinder: {
        //             uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
        //         },
        //         mediaEmbed: {
        //             previewsInData: true
        //         }
        //     })
        //     .then(editor => {
        //         console.log('CKEditor initialized successfully');
        //         if (questionCount > 1) {
        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });

        //             // Menambahkan logika AJAX
        //             $.ajax({
        //                 url: '/teacher/question/' + examId,
        //                 method: 'POST',
        //                 data: {
        //                     // content: editor.getData(),
        //                     content: 'asasas'
        //                 },
        //                 success: function(response) {
        //                     // Logika setelah pertanyaan berhasil disimpan
        //                     console.log(response);
        //                 },
        //                 error: function(error) {
        //                     // Logika jika ada kesalahan
        //                     console.error(error);
        //                 }
        //             });
        //         } else {
        //             console.error('Question count is not greater than 1');
        //         }
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });
        function removeOption(optionNumber) {
            const optionsContainer = document.getElementById('optionsContainer');
            const optionDiv = document.getElementById(`optionContainer${questionCount}-${optionNumber}`);
            optionsContainer.removeChild(optionDiv);

            ClassicEditor
                .instances
                .find(editor => editor.sourceElement.id === `editorOption${questionCount}-${optionNumber}`)
                .destroy();
            // Reorder option numbers
            const optionDivs = optionsContainer.children;
            for (let i = optionNumber; i < optionDivs.length; i++) {
                const currentOptionNumber = parseInt(optionDivs[i].id.replace(`optionContainer${questionCount}-`, ''));
                const newOptionNumber = currentOptionNumber - 1;
                optionDivs[i].id = `optionContainer${questionCount}-${newOptionNumber}`;
                optionDivs[i].querySelector('label').innerText = `Option ${newOptionNumber}`;
            }

            optionCount--;
        }

        function removeQuestion(questionNumber) {
            const questionContainer = document.getElementById(`questionContainer${questionNumber}`);

            if (questionContainer) {
                questionContainer.parentNode.removeChild(questionContainer);
                questionCount--;

                // Jika Anda ingin mereset opsi untuk setiap pertanyaan yang dihapus
                optionCount = 0;
            }
        }
    </script>
@endpush
