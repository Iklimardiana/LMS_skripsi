@extends('layouts.master')

@section('title')
    Register
@endsection
@section('content')
    <div class="p-4 border-2 border-gray-200 min-h-56 border-dashed m-24 rounded-lg">
        <section class="w-full p-6  bg-cyan-50 rounded-lg shadow">
            <div class="text-center pb-4 border-b border-cyan-400 rounded-t">
                <h1 class="text-3xl font-medium text-gray-800 capitalize text-center">Registrasi Akun</h1>
            </div>
            <form>
                <div class="grid grid-cols-1 gap-2 md:gap-6 mt-4 sm:grid-cols-2 ">
                    <section>
                        <div class="mb-3">
                            <label for="first_name" class="block mb-1 text-sm font-medium text-gray-800 ">Nama Depan
                            </label>
                            <input type="text" name="first_name" id="first_name"
                                class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Nama Depan Kamu" required="">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="block mb-1 text-sm font-medium text-gray-800 ">Nama
                                Belakang
                            </label>
                            <input type="text" name="last_name" id="last_name"
                                class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Nama Belakang Kamu" required="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="block mb-1 text-sm font-medium text-gray-800">Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="YourEmail@gmail.com" required="">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium text-gray-800" for="gender">Jenis
                                Kelamin</label>
                            <select
                                class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <option>Laki-Laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>
                    </section>
                    <section>
                        <div class="mb-3">
                            <label for="entry_year" class="block mb-1 text-sm font-medium text-gray-800">Tahun Masuk
                            </label>
                            <input type="number" name="entry_year" id="entry_year"
                                class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="contoh: 2023" required="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="block mb-1 text-sm font-medium text-gray-800">Kata
                                Sandi</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="mb-3">
                            <div class="sm:order-2 mt-0">
                                <label for="passwordConfirmation"
                                    class="block mb-1 text-sm font-medium text-gray-800">Konfirmasi
                                    Kata Sandi
                                </label>
                                <input type="password" name="passwordConfirmation" id="passwordConfirmation"
                                    placeholder="••••••••"
                                    class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required="">
                            </div>
                        </div>
                        <div class="flex justify-end mt-8">
                            <button
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-cyan-500 rounded-md hover:bg-cyan-700 focus:outline-none focus:bg-cyan-600">Daftar</button>
                        </div>
                    </section>
                </div>
                <span>
                    <p class="text-sm font-light text-black text-center">
                        Sudah Mempunyai Akun? <a href="/login" class="font-medium text-cyan-500 hover:underline ">Masuk</a>
                    </p>
                </span>
            </form>
        </section>
    </div>
@endsection
