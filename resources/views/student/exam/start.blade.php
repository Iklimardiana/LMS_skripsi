@extends('layouts.master')
@section('title')
    Start Exam
@endsection
@section('content')
    <section class="w-full mt-16">
        <div class="p-4 mt-16">
            <div class="inline">
                <div
                    class="flex flex-col md:flex-row p-2 gap-4 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg min-h-100">
                    <div class="h-auto w-full md:max-w-80 p-2 rounded-sm bg-cyan-50 border border-cyan-500 text-start">
                        <div class="flex items-center flex-col p-2 border-b border-cyan-400 rounded-t">
                            <p id="timer" class="font-medium md:text-2xl text-xl">
                                00:00:00
                            </p>
                            <button id="btnEnd"
                                class="border border-red-500 p-1 font-medium bg-white text-gray-900 w-full hover:bg-red-200">
                                akhiri ujian
                            </button>
                        </div>
                        <div class="p-2 max-h-17 md:h-auto">
                            <div id="listQuestion" class="flex flex-wrap items-center justify-start gap-2">
                                {{-- list soal --}}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <form id="formJawab">
                            @csrf
                            <div class="flex flex-col w-full border border-cyan-500 p-3 bg-cyan-50 mt-2 md:mt-0 space-y-2">
                                <h5 class="font-medium text-gray-900">Soal <span id="noSoal"></span></h5>
                                <div class="flex flex-col min-h-80">
                                    <input type="hidden" name="id" id="userExamId">
                                    <div id="div-question"
                                        class="h-auto p-2 rounded-sm bg-white border border-cyan-500 mb-2">
                                        {{-- soal  --}}
                                    </div>
                                    <div id="div-answer"
                                        class="flex flex-col h-auto p-2 rounded-sm bg-white border border-cyan-500 text-start">
                                        {{-- list jawaban --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-2 mb-2">
                                <div class="flex justify-between">
                                    <button type="button" id="btnPrev"
                                        class="flex items-center gap-1 text-xs md:text-sm font-medium border bg-cyan-500 hover:bg-cyan-700 text-white rounded-md px-2 py-1">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                                        </svg>
                                        Sebelumnya</button>
                                    <button type="submit"
                                        class="border text-xs md:text-sm font-medium bg-cyan-500 hover:bg-cyan-700 text-white rounded-md px-2 py-1">Simpan</button>

                                    <button type="button" id="btnNext"
                                        class="flex items-center gap-1 text-xs md:text-sm font-medium border bg-cyan-500 hover:bg-cyan-700 text-white rounded-md px-2 py-1">
                                        Selanjutnya
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const idUserExam = '{{ $userExam->id }}';
        const idExam = '{{ $userExam->idExam }}';
        const end = new Date('{{ $userExam->finish }}').getTime()
    </script>
    <script>
        const btnPrev = $('#btnPrev')
        const btnNext = $('#btnNext')
        const btnRagu = $('#btnRagu')

        let x = setInterval(() => {
            const timer = document.getElementById('timer');
            let now = new Date().getTime();
            let distance = end - now;

            // calc
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // warning
            if (hours == 0 && minutes < 5) {
                timer.style.color = 'red';
            }

            //
            if (hours < 10) {
                hours = "0" + hours
            }
            if (minutes < 10) {
                minutes = "0" + minutes
            }
            if (seconds < 10) {
                seconds = "0" + seconds
            }

            // show timer
            timer.innerHTML = hours + ":" + minutes + ":" + seconds;

            if (distance < 0) {
                clearInterval(x);
                timer.innerHTML = 'WAKTU HABIS!';
                timer.style.color = 'red';
                ujianSelesai()
            }
        }, 1000);

        function loadSoal(page = 1) {
            $.get({
                url: '/student/question',
                data: {
                    idUserExam: idUserExam,
                    page: page
                },
                success: function(res) {
                    const data = res.data[0]
                    const questions = data.question
                    $('#userExamId').val(data.id)

                    // no soal
                    $('#noSoal').html(res.current_page)

                    // soal
                    $('#div-question').html(questions.content)

                    // jawaban
                    const answer = questions.answer
                    divJawaban = $('#div-answer')
                    divJawaban.html('')

                    const answerChoice = questions.answer
                    let html = ''

                    answerChoice.forEach(function(item, index) {
                        html += `
                        <div class="flex flex-row gap-1">
                            <input class="mt-1" type="radio" id="pilihan${index}" name="user_answer" value="${item.id}" ${item.id == data.user_answer ? 'checked' : ''}>
                            <label for="pilihan${index}">${item.answer_content}</label>
                        </div>`;
                    })

                    divJawaban.html(html)

                    // nav prev
                    btnPrev.removeAttr('disabled')
                    btnPrev.data('id', res.current_page - 1)
                    if (res.prev_page_url == null) {
                        btnPrev.attr('disabled', 'disabled');
                        btnPrev.removeClass('hover:bg-cyan-700');
                    } else {
                        btnPrev.addClass('hover:bg-cyan-700');
                    }

                    // nav next
                    btnNext.removeAttr('disabled');
                    btnNext.data('id', res.current_page + 1)
                    if (res.next_page_url == null) {
                        btnNext.attr('disabled', 'disabled');
                        btnNext.removeClass('hover:bg-cyan-700');
                    } else {
                        btnNext.addClass('hover:bg-cyan-700');
                    }

                },
                error: function(err) {
                    console.log(err)
                }
            })
        }
        loadSoal()

        // btn prev
        btnPrev.on('click', function() {
            const data = $(this).data()
            loadSoal(data.id)
        })

        // btn next
        btnNext.on('click', function() {
            const data = $(this).data()
            loadSoal(data.id)
        })

        function daftarSoal() {
            $.get({
                url: '/student/question-list',
                data: {
                    idUserExam: idUserExam
                },
                success: function(res) {
                    let html = ''
                    res.forEach(function(item, index) {
                        let colorClass = item.user_answer != null ? 'bg-cyan-500 text-white' :
                            'bg-white';

                        html +=
                            `<button id="btnPilihan${index + 1}" class="border text-center border-cyan-500 py-1 w-10 ${colorClass} btn-listQuestion" data-id="${index + 1}">${index + 1}</button>`;
                    });

                    $('#listQuestion').html(html);
                }
            })
        }
        daftarSoal()

        // pilih soal
        $(document).on('click', '.btn-listQuestion', function() {
            const data = $(this).data()
            // daftarSoal()
            loadSoal(data.id)
        })

        // simpan jawaban
        $('#formJawab').on('submit', function(e) {
            e.preventDefault();

            const form = new FormData(this)

            $.ajax({
                type: 'POST',
                url: '/student/save-answer',
                data: form,
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        title: 'Jawaban berhasil disimpan',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2000,
                    });
                    daftarSoal()
                },
                error: function(err) {
                    console.error(err);
                }
            });
        })

        // Akhiri Ujian
        $('#btnEnd').on('click', function() {
            Swal.fire({
                title: 'Akhiri Ujian',
                text: "Anda yakin ingin mengakhiri ujian? Pastikan semua jawaban sudah terisi dengan benar",
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Yakin'
            }).then((done) => {
                if (done.value) {
                    ujianSelesai()
                }
            })
        })

        function ujianSelesai() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.post({
                url: '/student/finish-exam',
                data: {
                    idUserExam: idUserExam,
                    _token: csrfToken
                },
                success: function(res) {
                    Swal.fire('Ujian Telah Berakhir', 'Anda akan dialihkan ke halaman Beranda', 'success').then(
                        () => {
                            window.location.href = '/student/subject'
                        })
                }
            })
        }
    </script>
@endpush
