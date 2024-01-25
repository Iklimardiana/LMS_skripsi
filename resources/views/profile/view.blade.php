@extends('layouts.master')
@section('title')
    Profile Teacher
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto rounded-lg">
            <div class="grid max-w-screen-xl md:grid-cols-12 gap-4 lg:grid-cols-12">
                <div class="flex justify-center md:col-span-2">
                    <img class="rounded-full w-36 h-40 border border-cyan-500 object-cover"
                        src="{{ asset('images/avatar/' . $profile->avatar) }}" alt="Profile Image">
                </div>
                <div class="md:flex md:col-span-10">
                    <div class="w-full bg-cyan-50 rounded-lg border-cyan-500 shadow mx-auto">
                        <form class="p-3">
                            <div class="grid grid-cols-1 gap-2 md:gap-6 mt-4 md:grid-cols-2 ">
                                <section>
                                    <div class="mb-3">
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-800 ">Nama
                                            Depan
                                        </label>
                                        <input type="text" name="first_name" id="first_name"
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            value="{{ $profile->first_name }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="block mb-1 text-sm font-medium text-gray-800 ">Nama
                                            Belakang
                                        </label>
                                        <input type="text" name="last_name" id="last_name"
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            value="{{ $profile->last_name }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="block mb-1 text-sm font-medium text-gray-800">Email
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            value="{{ $profile->email }}" disabled>
                                    </div>
                                    @if (Auth::user()->role === 'student')
                                        <div class="mb-3">
                                            <label for="entry_year"
                                                class="block mb-1 text-sm font-medium text-gray-800">Tahun
                                                Masuk
                                            </label>
                                            <input type="number" name="entry_year" id="entry_year"
                                                class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                value="{{ $profile->entry_year }}" disabled>
                                        </div>
                                    @endif
                                </section>
                                <section>
                                    <div class="mb-3">
                                        <label class="block mb-1 text-sm font-medium text-gray-800" for="gender">
                                            Jenis Kelamin
                                        </label>
                                        <select
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            name="gender" id="gender" disabled>
                                            <option value="{{ $profile->gender }}">
                                                @if ($profile->gender == 'L')
                                                    Laki-Laki
                                                @elseif ($profile->gender == 'P')
                                                    Perempuan
                                                @endif
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="block mb-1 text-sm font-medium text-gray-800 ">Nomor
                                            Telpon
                                        </label>
                                        <input type="number" name="phone" id="phone"
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            value="{{ $profile->phone }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1 text-sm font-medium text-gray-900" for="photo">Ganti
                                            Foto Profile</label>
                                        <input type="file"
                                            class="block w-full text-sm text-gray-900 border border-cyan-400 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-cyan-500"
                                            aria-describedby="file_input_help" id="file_input" disabled name="photo">
                                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">
                                            {{ $profile->avatar }}</p>
                                    </div>
                                    <div class="flex justify-end mt-8">
                                        @if (Auth::user())
                                            <button
                                                class="w-20 flex items-center justify-center px-2 py-2 leading-5 text-white transition-colors duration-200 transform bg-cyan-500 rounded-md hover:bg-cyan-600 focus:outline-none focus:bg-cyan-600"
                                                onclick="redirectToEditProfile({{ $profile->id }}, '{{ $profile->role }}')"
                                                type="button">
                                                <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 18">
                                                    <path
                                                        d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                    <path
                                                        d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                </svg>
                                                Edit
                                            </button>
                                        @endif
                                    </div>
                            </div>
                            </section>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
