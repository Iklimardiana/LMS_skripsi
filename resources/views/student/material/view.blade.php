@extends('layouts.master')
@section('title')
    Learning Page
@endsection
@section('content')
    <section class="w-full mt-16">
        <!-- drawer init and show -->
        <div class="fixed left-0 top-24 z-50">
            <button
                class="text-white border-y border-r border-cyan-50 bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-400 font-medium rounded-r-md text-sm px-2 py-2.5"
                type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                aria-controls="drawer-navigation">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <!-- drawer component -->
        <div id="drawer-navigation"
            class="fixed top-0 left-0 mt-16 z-50 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-cyan-50 dark:bg-gray-800 border border-cyan-400 pb-16"
            tabindex="-1" aria-labelledby="drawer-navigation-label">
            <h5 id="drawer-navigation-label"
                class="text-base border-cyan-500 pb-4 font-semibold text-gray-500 uppercase dark:text-gray-400">
                {{ $subject->name }}</h5>
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center z-40">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div class="flex items-center justify-between gap-1">
                @if ($currentProgres ? $currentProgres->sequence : '')
                    @php
                        $totalMaterials = $subject->Material->count();
                        $totalAssignments = $subject->Assignment->where('category', 'fromteacher')->count();

                        $completedAssignments = $subject->Assignment
                            ->where('category', 'fromstudent')
                            ->where('idUser', Auth::id())
                            ->count();

                        $totalProgress = $totalMaterials + max(0, $totalAssignments - $completedAssignments);

                        $progressPercentage = round(($currentProgres->sequence / $totalProgress) * 100);
                    @endphp
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-cyan-500 h-2.5 rounded-full" style="width: {{ $progressPercentage }}%">
                        </div>
                    </div>
                    <p>
                        {{ $progressPercentage }}%
                    </p>
                @else
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-cyan-500 h-2.5 rounded-full" style="width: 0%">
                        </div>
                    </div>
                    <p>
                        0%
                    </p>
                @endif
            </div>
            <div class="py-4 overflow-y-auto">
                <ul class=" font-medium">
                    @foreach ($subject->material->sortBy('sequence') as $material)
                        @if ($currentProgres == '1')
                            <li class="{{ $material->sequence == 1 ? 'border-t' : '' }} border-b border-cyan-500">
                                <a href="{{ route('learning-page', ['id' => $subject->id, 'sequence' => $material->sequence]) }}"
                                    class="flex items-center p-2 text-gray-900 hover:bg-white hover:border hover:border-cyan-500 {{ $material->sequence == $currentSequence ? 'active' : '' }}">
                                    <span class="ms-3">{{ $material->name }}</span>
                                </a>
                            </li>
                        @elseif ($material->sequence <= $currentProgres->sequence)
                            <li class="{{ $material->sequence == 1 ? 'border-t' : '' }} border-b border-cyan-500">
                                <a href="{{ route('learning-page', ['id' => $subject->id, 'sequence' => $material->sequence]) }}"
                                    class="flex items-center p-2 text-gray-900 hover:bg-white hover:border hover:border-cyan-500 {{ $material->sequence == $currentSequence ? 'active' : '' }}">
                                    <span class="ms-3">{{ $material->name }}</span>
                                </a>
                            </li>
                        @else
                            <li class="{{ $material->sequence == 1 ? 'border-t' : '' }} border-b border-cyan-500">
                                <a onclick="showAlertAside()"
                                    class="flex items-center p-2 text-gray-900 hover:bg-white hover:border hover:border-cyan-500 cursor-not-allowed {{ $material->sequence == $currentSequence ? 'active' : '' }}"
                                    disabled>
                                    <span class="ms-3">{{ $material->name }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="p-4 mt-16">
            @php
                $currentMaterial = $subject->Material()->where('sequence', $currentSequence)->first();
                $currentMaterialId = $currentMaterial ? $currentMaterial->id : null;
            @endphp
            @if ($attachment->where('idMaterial', $currentMaterialId)->where('category', 'fromteacher')->isNotEmpty())
                <div
                    class="w-full flex flex-col md:flex-row px-5 py-4 gap-2 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg min-h-100">
                    <div
                        class="overflow-x-auto h-auto md:min-w-80 z-30 p-2 rounded-lg bg-cyan-50 border border-cyan-500 text-start">
                        <a href="/student/subject/">
                            <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                        </a>
                        <table class="overflow-x-auto text-sm text-left rtl:text-right text-gray-500 w-full mt-2">
                            <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                                <tr>
                                    <th colspan="2" class="p-2">Penugasan</th>
                                </tr>
                            </thead>
                            <thead class="border">
                                <tr class="odd:bg-white even:bg-gray-50 border border-cyan-500 text-center">
                                    <th
                                        class="border bg-cyan-200 border-cyan-500 py-1 font-bold text-gray-900 whitespace-nowrap">
                                        Lampiran Tugas
                                    </th>
                                    <th class="bg-cyan-200 py-1 font-bold text-gray-900 whitespace-nowrap">Unggah Tugas Anda
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attachment as $item)
                                    @if ($item->idMaterial == $currentMaterialId)
                                        <tr class="odd:bg-white even:bg-gray-50 border border-cyan-500 text-center">
                                            <th
                                                class="border border-cyan-500 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    <button type="button"
                                                        onclick="previewAssignment('{{ $item->type }}', '{{ $item->attachment }}', '{{ $item->user->role }}')"
                                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                                        title="Klik untuk melihat tugas">
                                                        <svg class="w-5 h-5" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 16 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M4.828 10h6.239m-6.239 4h6.239M6 1v4a1 1 0 0 1-1 1H1m14-4v16a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2Z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                <button type="button"
                                                    onclick="redirectToAddSubmission({{ $currentMaterialId }})"
                                                    class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                                    title="klik untuk mengunggah tugas">
                                                    <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4c0 .6.4 1 1 1h14c.6 0 1-.4 1-1v-4c0-.6-.4-1-1-1h-2M8 9l4-5 4 5m1 8h0" />
                                                    </svg>
                                                </button>
                                            </th>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if ($submission->where('idMaterial', $currentMaterialId)->where('category', 'fromstudent')->where('idUser', Auth::user()->id)->isNotEmpty())
                            <table class="mt-3 overflow-x-auto text-sm text-left rtl:text-right text-gray-500 w-full">
                                <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                                    <tr>
                                        <th colspan="2" class="p-2">Lampiran Tugas Anda</th>
                                    </tr>
                                </thead>
                                <thead class="border">
                                    <tr class="odd:bg-white even:bg-gray-50 border border-cyan-500 text-center">
                                        <th
                                            class="border bg-cyan-200 border-cyan-500 py-1 font-bold text-gray-900 whitespace-nowrap">
                                            Lampiran Unggahan
                                        </th>
                                        <th class="bg-cyan-200 py-1 font-bold text-gray-900 whitespace-nowrap">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submission as $item)
                                        @if ($item->idMaterial == $currentMaterialId)
                                            <tr class="odd:bg-white even:bg-gray-50 border border-cyan-500 text-center">
                                                <th
                                                    class="border border-cyan-500 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                    <div class="flex items-center justify-center">
                                                        <button type="button"
                                                            onclick="previewAssignment('{{ $item->type }}', '{{ $item->attachment }}', '{{ $item->user->role }}')"
                                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                                            title="Klik untuk melihat tugas">
                                                            <svg class="w-5 h-5" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 16 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M4.828 10h6.239m-6.239 4h6.239M6 1v4a1 1 0 0 1-1 1H1m14-4v16a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </th>
                                                <th
                                                    class="flex flex-items-center justify-center gap-1 px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        onclick="deleteData(event, '/student/submission/{{ $item->id }}')"
                                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                                        title="klik untuk menghapus tugas">
                                                        <svg class="w-5 h-5" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 18 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                        </svg>
                                                    </button>
                                                    <button type="button"
                                                        onclick="redirectToEditSubmission({{ $item->id }})"
                                                        class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm p-2 focus:outline-none"
                                                        title="Klik untuk edit tugas">
                                                        <svg class="feather feather-edit w-5 h-5" fill="none"
                                                            stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                            xmlns=" http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                        </svg>
                                                    </button>
                                                </th>
                                            </tr>
                                            <tr class="bg-white border border-cyan-500 text-center">
                                                <th colspan="2" class="p-2 text-gray-900">Nilai: {{ $item->score }}
                                                </th>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @else
                    <div
                        class="w-full lg:w-3/4 mx-auto flex flex-col md:flex-row px-5 py-4 gap-2 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg min-h-100">
            @endif
            <div class="flex flex-col w-full">
                @php
                    $currentMaterial = $subject->material->where('sequence', $currentSequence)->first();
                @endphp
                <div class="flex flex-col w-full rounded-lg border border-cyan-500 p-3 bg-cyan-50 mt-2 md:mt-0 space-y-2">
                    @if ($attachment->where('idMaterial', $currentMaterialId)->where('category', 'fromteacher')->isEmpty())
                        <a href="/student/subject/">
                            <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                        </a>
                    @endif
                    <div class="flex flex-col min-h-80">
                        <div id="content" class="h-auto p-2 rounded-lg bg-white border border-cyan-500 mb-2">
                            <h1 class=" text-center font-medium text-3xl">{{ $currentMaterial->name }}</h1>
                            <hr class="mt-2 border-cyan-500">
                            <div class="mt-2 text-justify">
                                {!! $convertedContent !!}
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-8 mb-2">
                        <div class="flex justify-between">
                            <div>
                                @if ($currentSequence > 1)
                                    <a href="{{ route('learning-page', ['id' => $subject->id, 'sequence' => $currentSequence - 1]) }}"
                                        class="border bg-cyan-500 hover:bg-cyan-700 text-white rounded-md py-2 px-5">Sebelumnya</a>
                                @endif
                            </div>
                            <div class="text-right">
                                @if ($currentSequence < $subject->material->count())
                                    <a href="{{ route('learning-page', ['id' => $subject->id, 'sequence' => $currentSequence + 1]) }}"
                                        class="border bg-cyan-500 hover:bg-cyan-700 text-white rounded-md p-2">Selanjutnya</a>
                                @elseif($currentSequence == $subject->material->count())
                                    <a href="/student/subject"
                                        class="border bg-cyan-500 hover:bg-cyan-700 text-white rounded-md py-2 px-5">Kembali
                                        ke
                                        Dashboard</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var toastMessage = '{{ session('toast.message') }}';
        var toastType = '{{ session('toast.type') }}';

        if (toastMessage) {
            Swal.fire({
                title: toastMessage,
                icon: toastType,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2000,
            });
        }

        function showAlertAside() {
            swal({
                title: "Mohon untuk membaca materi hingga akhir",
                icon: 'warning',
            })
        }

        function redirectToAddSubmission(idMaterial) {
            var baseUrl = '/student/materials/';
            var addSubmissionUrl = baseUrl + idMaterial + '/submission/create/';
            window.location.href = addSubmissionUrl;
        }

        function redirectToEditSubmission(idSubmission) {
            var baseUrl = '/student/submission/';
            var editSubmissionUrl = baseUrl + idSubmission + '/edit';
            window.location.href = editSubmissionUrl;
        }
    </script>
@endpush
