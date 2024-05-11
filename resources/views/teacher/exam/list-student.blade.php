@extends('layouts.master')
@section('title')
    Daftar Ujian Siswa
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <form action="/teacher/exam/student-list/{{ $exam->id }}" class="w-full mb-3">
            <div class="flex">
                <div class="relative w-full">
                    <input type="search" name="keyword" value="{{ request('keyword') }}"
                        class="block rounded-l-md p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-cyan-300 focus:ring-cyan-500 focus:border-cyan-500"
                        placeholder="Cari nama...">
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
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="flex items-center justify-between gap-2 mb-2">
                <a href="/teacher/exam/{{ $exam->idSubject }}">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                <div class="mb-2">
                    <p class="text-center text-gray-900 font-medium text-xl">Daftar Nilai Ujian {{ $exam->title }} Siswa
                    </p>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-900">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($userExams as $userExam)
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 b border border-cyan-500">
                                <td class="px-6 py-1">
                                    {{ $iteration++ }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $userExam->student->first_name . ' ' . $userExam->student->last_name }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $userExam->score }}
                                </td>
                                <td class="px-6 py-1">
                                    @if ($userExam->status == 1)
                                        <p>Selesai</p>
                                    @else
                                        Belum selesai
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-gray-50 even:bg-cyan-50 border border-cyan-500">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-cyan-500">
                                    Daftar ujian siswa tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $userExams->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    <script>
        function showAlert() {
            alert('Belum ada nilai')
        }
    </script>
@endsection
