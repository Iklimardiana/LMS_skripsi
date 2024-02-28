@extends('layouts.master')
@section('title')
    @if (Auth::user()->role === 'teacher')
        Teacher Profile Edit
    @elseif(Auth::user()->role === 'student')
        Student Profile Edit
    @endif
@endsection
@section('content')
    <div class="p-4 mt-16 sm:ml-64">
        <div class="flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto rounded-lg">
            <div class="grid max-w-screen-xl md:grid-cols-12 gap-4 lg:grid-cols-12">
                <div class="flex justify-center md:col-span-2">
                    <img class="rounded-lg w-28 h-32 md:w-32 md:h-36 border border-cyan-500 object-cover"
                        src="{{ asset('images/avatar/' . $profile->avatar) }}" alt="Profile Image">
                </div>
                <div class="md:flex md:col-span-10">
                    <div class="w-full bg-cyan-50 rounded-lg border-cyan-500 shadow mx-auto">
                        @if (Auth::User()->role == 'teacher')
                            <form id="editProfile" action="/teacher/profile/{{ $profile->id }}" method="POST"
                                enctype="multipart/form-data" class="p-3">
                        @endif
                        @if (Auth::User()->role == 'student')
                            <form id="editProfile" action="/student/profile/{{ $profile->id }}" method="POST"
                                enctype="multipart/form-data" class="p-3">
                        @endif
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-1 gap-2 md:gap-6 mt-4 md:grid-cols-2 ">
                            <section>
                                <div class="mb-3">
                                    <label for="first_name" class="block mb-1 text-sm font-medium text-gray-800 ">Nama
                                        Depan
                                    </label>
                                    <input type="text" name="first_name" id="first_name"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                        value="{{ $profile->first_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="block mb-1 text-sm font-medium text-gray-800 ">Nama
                                        Belakang
                                    </label>
                                    <input type="text" name="last_name" id="last_name"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                        value="{{ $profile->last_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="block mb-1 text-sm font-medium text-gray-800">Email
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                        value="{{ $profile->email }}">
                                </div>
                                @if (Auth::user()->role === 'student')
                                    <div class="mb-3">
                                        <label for="entry_year" class="block mb-1 text-sm font-medium text-gray-800">Tahun
                                            Masuk
                                        </label>
                                        <input type="number" name="entry_year" id="entry_year"
                                            class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                            value="{{ $profile->entry_year }}">
                                    </div>
                                @endif
                            </section>
                            <section>
                                <div class="mb-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-800" for="gender">
                                        Jenis Kelamin
                                    </label>
                                    <select
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                        name="gender" id="gender">
                                        <option value="L" {{ $profile->gender == 'L' ? 'selected' : '' }}>Laki-Laki
                                        </option>
                                        <option value="P" {{ $profile->gender == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="block mb-1 text-sm font-medium text-gray-800 ">Nomor
                                        Telpon
                                    </label>
                                    <input type="number" name="phone" id="phone"
                                        class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                        value="{{ $profile->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-900" for="avatar">Ganti
                                        Foto Profile</label>
                                    <input type="file"
                                        class="block w-full text-sm text-gray-900 border border-cyan-400 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-cyan-500"
                                        aria-describedby="file_input_help" id="avatar" name="avatar">
                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">
                                        {{ $profile->avatar }}</p>
                                </div>
                                <div class="flex space-x-2 justify-end mt-8">
                                    <button
                                        class="w-25 flex items-center justify-center px-2 py-2 leading-5 text-white transition-colors duration-200 transform bg-cyan-500 rounded-md hover:bg-cyan-700 focus:outline-none focus:ring-4 focus:ring-cyan-300 focus:bg-cyan-600"
                                        type="submit">
                                        <svg class="me-1 -ms-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                            data-name="Layer 1" viewBox="0 0 64 64" id="save">
                                            <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"
                                                d="M58,58H12L6,52V8A2,2,0,0,1,8,6H56a2,2,0,0,1,2,2Z">
                                            </path>
                                            <rect width="36" height="24" x="14" y="6" fill="none" stroke="#FFFFFF"
                                                stroke-miterlimit="10" stroke-width="4"></rect>
                                            <rect width="24" height="16" x="18" y="42" fill="none"
                                                stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4"></rect>
                                            <line x1="26" x2="26" y1="48" y2="58"
                                                fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="4">
                                            </line>
                                        </svg>
                                        Perbarui
                                    </button>
                                    <button
                                        class="w-25 flex items-center justify-center px-2 py-2 leading-5 text-white transition-colors duration-200 transform bg-cyan-500 focus:ring-4 focus:ring-cyan-300 rounded-md hover:bg-cyan-700 focus:outline-none focus:bg-cyan-600"
                                        onclick="redirectToProfile({{ $profile->id }}, '{{ $profile->role }}')"
                                        type="button">
                                        <svg class="w-5 h-5 mr-1 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Batal
                                    </button>
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
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function submitProfileForm() {
            // Assuming you have an id on your form
            var form = document.getElementById('editProfile');

            // Serialize the form data
            var formData = new FormData(form);

            // Perform AJAX request
            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.location.href = '/student/profile/{{ $profile->id }}';
                    Swal.fire({
                        title: 'Profil Berhasil Diperbarui',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2000,
                    });

                    // Optionally, reset the form or perform other actions
                    // form.reset();
                },
                error: function(error) {
                    // Handle error if needed
                    console.error('Error:', error);
                }
            });
        }
    </script>
    <script>
        function redirectToProfile(userId, userRole) {
            if (userRole == 'student') {
                baseUrl = '/student/profile/';
            } else if (userRole == 'teacher') {
                baseUrl = '/teacher/profile/';
            }

            var editProfileUrl = baseUrl + userId;
            window.location.href = editProfileUrl;
        }
    </script>
@endpush
