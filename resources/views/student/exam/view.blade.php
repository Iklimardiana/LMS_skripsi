@extends('layouts.master')
@section('title')
    Exam List-student
@endsection
@section('content')
    <div class="mb-2 border-b border-cyan-200 md:ml-64 lg:ml-64">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 text-cyan-500 rounded-t-lg hover:text-cyan-600 hover:border-cyan-300"
                    id="active-exam-tab" data-tabs-target="#active-exam" type="button" role="tab"
                    aria-controls="active-exam" aria-selected="false">Daftar Ujian</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg text-cyan-500  hover:text-cyan-600 hover:border-cyan-300"
                    id="history-tab" data-tabs-target="#history" type="button" role="tab" aria-controls="history"
                    aria-selected="false">Riwayat Ujian</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content" class="md:ml-64 lg:ml-64">
        <div class="hidden p-4 rounded-lg " id="active-exam" role="tabpanel" aria-labelledby="active-exam-tab">
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
                        <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                    </a>
                </div>
                @unless (
                    $exams->where('status', '1')->where(function ($item) use ($examAvailability) {
                            return in_array($examAvailability[$item->id]['availability'], ['start', 'continue']);
                        })->isNotEmpty())
                    <p class="text-gray-900 text-center font-medium">Ujian Tidak Ditemukan</p>
                @else
                    @forelse ($exams as $exam)
                        @if ($examAvailability[$exam->id]['availability'] == 'start')
                            <div
                                class="flex items-center justify-between h-36 pr-2 md:pr-3 py-0 pl-0 justify-items-center rounded-lg bg-cyan-50 border border-cyan-500">
                                <div class="hidden sm:flex">
                                    <img class="rounded-l-lg w-28 md:w-80 h-36 border-y border-cyan-500 object-cover"
                                        src="{{ asset('images/thumbnail/thumbnailDefault.jpg') }}" alt="Subject Image">
                                </div>
                                <div class="m-3 text-start sm:text-center text-gray-900">
                                    <p class="font-semibold text-lg md:text-2xl">{{ $exam->title }}</p>
                                    <p class="underline">{{ $exam->type }} | {{ $exam->duration }} menit</p>
                                </div>
                                <div class="flex flex-col space-y-2 items-center justify-end">
                                    @if ($ongoingExam)
                                        <button type="button" onclick="showAlert()"
                                            class="text-white bg-gray-400 cursor-not-allowed font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none">
                                            Mulai
                                        </button>
                                    @else
                                        <button type="button" data-modal-target="beginExam-modal-{{ $exam->id }}"
                                            data-modal-toggle="beginExam-modal-{{ $exam->id }}"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm w-16 md:w-20  px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none">
                                            Mulai
                                        </button>
                                    @endif
                                </div>
                                <!-- start modal -->
                                <div id="beginExam-modal-{{ $exam->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div
                                            class="relative bg-cyan-50 rounded-lg shadow-md shadow-cyan-200 border-2 border-cyan-200">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b border-cyan-400 rounded-t">
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    Mulai Ujian
                                                </h3>
                                                <button type="button"
                                                    class="bg-transparent hover:bg-gray-200 hover:text-cyan-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center text-cyan-500"
                                                    data-modal-toggle="beginExam-modal-{{ $exam->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form action="{{ route('start.exam', ['id' => $exam->id]) }}" method="POST"
                                                class="p-4 md:p-5">
                                                @csrf
                                                <input type="hidden" name="idExam">
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <table class="w-full text-sm text-gray-500">
                                                            <thead
                                                                class="text-xs text-start text-gray-900 uppercase border border-cyan-500">
                                                                <tr>
                                                                    <th class="px-2 py-3 border border-cyan-500 text-start">
                                                                        Nama Ujian
                                                                    </th>
                                                                    <td class="border border-cyan-500 px-2 py-3 ">
                                                                        {{ $exam->title }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="px-2 py-3 border border-cyan-500 text-start">
                                                                        Durasi
                                                                    </th>
                                                                    <td class="border border-cyan-500 px-2 py-3 ">
                                                                        {{ $exam->duration . ' menit' }}</td>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="flex flex-row justify-end gap-2">
                                                    <button type="button"
                                                        data-modal-toggle="beginExam-modal-{{ $exam->id }}"
                                                        class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                        Batalkan
                                                    </button>
                                                    <button type="submit"
                                                        class="text-white inline-flex items-center bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                        Mulai
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        @elseif ($examAvailability[$exam->id]['availability'] == 'continue')
                            @php
                                $now = now();
                                $finishTime = $examAvailability[$exam->id]['finish'];
                            @endphp
                            <div
                                class="flex items-center justify-between h-24 sm:h-36 pr-2 md:pr-3 py-0 pl-0 justify-items-center rounded-lg bg-cyan-50 border border-cyan-500">
                                <div class="hidden sm:flex">
                                    <img class="rounded-l-lg w-28 md:w-80 h-36 border-y border-cyan-500 object-cover"
                                        src="{{ asset('images/thumbnail/thumbnailDefault.jpg') }}" alt="Subject Image">
                                </div>
                                <div class="m-3 text-start sm:text-center text-gray-900">
                                    <p class="font-semibold text-lg md:text-2xl">{{ $exam->title }}</p>
                                    <p class="underline">{{ $exam->type }} | {{ $exam->duration }} menit</p>
                                </div>
                                <div class="flex flex-col space-y-2 items-center justify-end">
                                    @if ($now <= $finishTime)
                                        <button type="button" onclick="examcontinue({{ $exam->id }})"
                                            class=" text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-md md:rounded-lg text-sm px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none  ">
                                            Lanjutkan
                                        </button>
                                    @else
                                        <button type="button" onclick="ujianSelesai()"
                                            class="cursor-not-allowed text-white bg-gray-500 hover:bg-gray-700 focus:ring-4 text-sm px-1 py-1 md:px-5 md:py-2 me-2 focus:outline-none">
                                            Waktu Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @empty
                        <p class="text-gray-900 text-center">Ujian Tidak Ditemukan</p>
                    @endforelse
                @endunless
            </div>
        </div>
        <div class="hidden p-4 rounded-lg" id="history" role="tabpanel" aria-labelledby="history-tab">
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg">
                <div class="w-7">
                    <a href="/student/subject">
                        <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                    </a>
                </div>
                {{-- @unless ($exams->where('status', '1')->isNotEmpty()) --}}
                @unless (
                    $exams->where('status', '1')->where(function ($item) use ($examAvailability) {
                            return in_array($examAvailability[$item->id]['availability'], ['score']);
                        })->isNotEmpty())
                    <p class="text-gray-900 text-center font-medium">Tidak ada riwayat ujian</p>
                @else
                    <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                                <tr>
                                    <th scope="col" class="px-2 py-3 border border-cyan-50">
                                        No.
                                    </th>
                                    <th scope="col" class="px-2 py-3 border border-cyan-50">
                                        Nama Ujian
                                    </th>
                                    <th scope="col" class="px-2 py-3 border border-cyan-50">
                                        Durasi
                                    </th>
                                    <th scope="col" class="px-2 py-3 border border-cyan-50">
                                        Nilai
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($exams as $exam)
                                    @if ($examAvailability[$exam->id]['availability'] == 'score')
                                        <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                            <td class="p-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                                {{ $iteration++ }}
                                            </td>
                                            <td class="p-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                                {{ $exam->title }}
                                            </td>
                                            <td class="p-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                                {{ $exam->duration }} menit
                                            </td>
                                            <td class="p-2 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                                {{ $examAvailability[$exam->id]['score'] }}
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                            Ujian tidak ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endunless
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function examcontinue(idExam) {
            window.location.href = '/student/exam-start/' + idExam;
        }

        function showAlert() {
            Swal.fire({
                title: 'Tidak Diizinkan',
                text: "Anda sedang menjalankan ujian lain, mohon selesaikan terlebih dahulu",
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        }

        @if ($ongoingExam !== null)
            const idUserExam = {{ $ongoingExam->id }}
        @endif

        function ujianSelesai() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.post({
                url: '/student/finish-exam',
                data: {
                    idUserExam: idUserExam,
                    _token: csrfToken
                },
                success: function(res) {
                    console.log(res)

                    Swal.fire('Ujian Telah Berakhir', 'Anda akan dialihkan ke halaman Beranda', 'success').then(
                        () => {
                            window.location.href = '/student/subject'
                        })
                }
            })
        }
    </script>
@endpush
