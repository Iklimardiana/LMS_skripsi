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
                <form id="questionForm" enctype="multipart/form-data" method="POST" class="md:w-3/4 w-full">
                    @csrf
                    <div id="questionsContainer">
                        <!-- Container untuk satu textarea soal -->
                        <div class="mb-3">
                            <label for="content" class="font-medium"> Soal 1</label>
                            {{-- <div class="gap-1">
                                <textarea
                                    class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500"
                                    name="content" id="editor{{ $exam->id }}"></textarea>
                                <button type="button" id="addOptionBtn" onclick="addOption({{ $exam->id }})"
                                    class="text-red-500">Tambah
                                    opsi jawaban</button>
                            </div> --}}
                            <div class="gap-1">
                                <textarea
                                    class="flex text-sm text-gray-900 border border-cyan-400 rounded-md bg-gray-50 focus:outline-none file:bg-cyan-500 w-full md:min-w-96 mt-2 focus:ring-cyan-500 focus:border-cyan-500"
                                    name="content" id="editor{{ $exam->id }}"></textarea>
                                <button type="button" id="addOptionBtn" onclick="addOption({{ $exam->id }})"
                                    class="text-red-500">Tambah
                                    opsi jawaban</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <button type="button" onclick="saveOption()"
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
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let firstOptionAdded = false;
        let optionCount = 0;

        function addOption(idExam) {
            const questionContent = document.querySelector(`#editor${idExam}`).value;

            // Menambahkan logika AJAX untuk menyimpan pertanyaan ke database
            $.ajax({
                url: '/teacher/question/' + idExam,
                method: 'POST',
                data: {
                    content: questionContent,
                    // tambahkan data lainnya sesuai kebutuhan
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Logika setelah pertanyaan berhasil disimpan
                    console.log('Question AJAX Success - Response:', response);

                    // Mendapatkan idQuestion dari response
                    const idQuestion = response.id;

                    // Menambahkan form option setelah pertanyaan disimpan
                    addOptionForm(idQuestion);

                    if (!firstOptionAdded) {
                        document.getElementById('addOptionBtn').style.display = 'none';
                        firstOptionAdded = true;
                    } else {
                        // Jika bukan pertama kali, panggil addOptionForm
                        addOptionForm(idQuestion);
                    }
                },
                error: function(error) {
                    // Logika jika ada kesalahan
                    console.error('Question AJAX Error - Error:', error);
                }
            });
        }

        function addOptionForm(idQuestion) {
            const optionsContainer = document.getElementById('questionsContainer');
            optionCount++;

            const optionDiv = document.createElement('div');
            optionDiv.classList.add('mb-3');
            optionDiv.id = `optionContainer${idQuestion}-${optionCount}`;

            const label = document.createElement('label');
            label.htmlFor = `option${optionCount}`;
            label.className = 'font-medium';
            label.innerText = `Option ${optionCount}`;
            optionDiv.appendChild(label);

            const inputContainer = document.createElement('div');
            inputContainer.classList.add('mb-3', 'gap-1');

            const input = document.createElement('input');
            input.id = `editorOption${idQuestion}-${optionCount}`;
            input.type = 'text';
            input.name = 'content';
            input.className = 'border border-cyan-400 rounded-md p-2 w-full';
            inputContainer.appendChild(input);

            // Dropdown (select) element
            const select = document.createElement('select');
            select.id = `selectOption${idQuestion}-${optionCount}`;
            select.name = 'isCorrect';
            select.className = 'border border-cyan-400 rounded-md p-2';

            // Opsi "Benar"
            const optionTrue = document.createElement('option');
            optionTrue.value = '1';
            optionTrue.text = 'Benar';
            select.appendChild(optionTrue);

            // Opsi "Salah"
            const optionFalse = document.createElement('option');
            optionFalse.value = '0';
            optionFalse.text = 'Salah';
            select.appendChild(optionFalse);

            inputContainer.appendChild(select);

            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.innerText = 'Hapus Option';
            deleteButton.className = 'text-red-500';
            deleteButton.addEventListener('click', () => removeOption(idQuestion, optionCount));
            inputContainer.appendChild(deleteButton);

            optionDiv.appendChild(inputContainer);
            optionsContainer.appendChild(optionDiv);

            const addOptionButton = document.createElement('button');
            addOptionButton.type = 'button';
            addOptionButton.innerText = 'Tambah Option';
            addOptionButton.className = 'text-green-500';
            addOptionButton.addEventListener('click', function() {
                // Mendapatkan nilai input dan select di sini
                const optionContent = document.querySelector(`#editorOption${idQuestion}-${optionCount}`).value;
                const selectElement = document.getElementById(`selectOption${idQuestion}-${optionCount}`);
                const correctAnswer = selectElement.options[selectElement.selectedIndex].value;

                // Menambahkan logika AJAX untuk menyimpan option ke database
                $.ajax({
                    url: '/teacher/option/' + idQuestion,
                    method: 'POST',
                    data: {
                        content: optionContent,
                        isCorrect: correctAnswer,
                        // tambahkan data lainnya sesuai kebutuhan
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Logika setelah option berhasil disimpan
                        console.log('Option AJAX Success - Response:', response);

                        // Menambahkan form option setelah option disimpan
                        addOptionForm(idQuestion);
                    },
                    error: function(error) {
                        // Logika jika ada kesalahan
                        console.error('Option AJAX Error - Error:', error);
                    }
                });
            });
            optionsContainer.appendChild(addOptionButton);
        }


        function removeOption(idQuestion, optionNumber) {
            const optionsContainer = document.getElementById('questionsContainer');
            const optionDiv = document.getElementById(`optionContainer${idQuestion}-${optionNumber}`);
            optionsContainer.removeChild(optionDiv);

            ClassicEditor
                .instances
                .find(editor => editor.sourceElement.id === `editorOption${idQuestion}-${optionNumber}`)
                .destroy();
            // Reorder option numbers
            const optionDivs = optionsContainer.children;
            for (let i = optionNumber; i < optionDivs.length; i++) {
                const currentOptionNumber = parseInt(optionDivs[i].id.replace(`optionContainer${idQuestion}-`, ''));
                const newOptionNumber = currentOptionNumber - 1;
                optionDivs[i].id = `optionContainer${idQuestion}-${newOptionNumber}`;
                optionDivs[i].querySelector('label').innerText = `Option ${newOptionNumber}`;
            }

            optionCount--;
        }
    </script>
@endpush
