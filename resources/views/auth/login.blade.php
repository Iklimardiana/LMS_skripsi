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
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email
                                </label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="email_kamu@gmail.com" required="">
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Kata
                                    Sandi</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-cyan-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    required="">
                            </div>
                            <div class="flex items-center justify-end text-gray-500">
                                <a href="#" class="text-sm font-medium text-primary-600 hover:underline ">Lupa
                                    Kata Sandi?</a>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Masuk</button>
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
