@extends('layouts.master')
@section('title')
    Login
@endsection
@section('content')
    <div
        class="grid max-w-screen-xl px-4 pt-5 pb-8 mx-auto md:grid-cols-12 lg:gap-8 xl:gap-6 lg:py-16 lg:grid-cols-12 lg:pt-5">
        <div class="md:flex md:col-span-6">
            <div class="w-full flex flex-col space-y-3 p-4 border-2 border-gray-200 border-dashed h-auto mb-5 rounded-lg">
                <div class="w-full bg-cyan-50 rounded-lg border-cyan-500 shadow mx-auto">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <div class="text-center pb-4 border-b border-cyan-400 rounded-t">
                            <h1 class="text-xl font-medium leading-tight tracking-tight text-gray-900 md:text-2xl">
                                Masuk Ke Akun Anda
                            </h1>
                        </div>
                        <form class="space-y-4 md:space-y-6" action="/login" method="POST">
                            @if (session()->has('message'))
                                <div id="alert-3"
                                    class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100"
                                    role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div class="flex ms-3 text-sm font-medium">
                                        {{ session('message') }}
                                    </div>
                                    <button type="button"
                                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                                        data-dismiss-target="#alert-3" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @if (session('loginError'))
                                <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
                                    role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div class="ms-3 text-sm font-medium">
                                        @if ($errors->any())
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        @if (session('loginError'))
                                            <p>{{ session('loginError') }}</p>
                                        @endif
                                    </div>
                                    <button type="button"
                                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                                        data-dismiss-target="#alert-2" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @csrf
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email
                                </label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                                    placeholder="Masukkan email">
                                @error('email')
                                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
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
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Kata
                                    Sandi</label>
                                <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi"
                                    class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 ">
                                @error('password')
                                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
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
                            <div class="flex items-center justify-end text-gray-500">
                                <a href="/forgot" class="text-sm font-medium text-cyan-500 hover:underline ">Lupa
                                    Kata Sandi?</a>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Masuk</button>
                            <p class="text-sm font-light text-black ">
                                Belum mempunyai akun? <a href="/register"
                                    class="font-medium text-cyan-500 hover:underline ">Daftar Di sini</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-center md:mt-0 md:col-span-6">
            <img class="m-auto h-auto" src="./images/hero.png" alt="hero image">
        </div>
    </div>
@endsection
