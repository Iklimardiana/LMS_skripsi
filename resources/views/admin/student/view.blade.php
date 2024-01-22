@extends('layouts.master')
@section('title')
    student-admin
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed h-auto mb-20 rounded-lg ">
            <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Avatar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($students as $student)
                            <tr class="odd:bg-white text-gray-900 border border-cyan-500 even:bg-gray-50">
                                <td class="px-6 py-1">
                                    {{ $iteration++ }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $student->first_name . ' ' . $student->last_name }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $student->email }}
                                </td>
                                <td class="px-6 py-1">
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/avatar/' . $student->avatar) }}"
                                        alt="photo profile guru">
                                </td>
                                <td class="px-6 py-1">
                                    <form action="/admin/student/{{ $student->id }}"method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-3 py-2.5 focus:outline-none"
                                            data-confirm-delete="true"
                                            onclick="deleteData(event, '{{ route('student.destroy', $student->id) }}')">
                                            <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                <path
                                                    d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p class="text-md text-center">Tidak Ada Siswa</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
