@extends('layouts.master')

@section('title')
    Beranda
@endsection
@section('content')
    <div
        class="grid max-w-screen-xl px-4 pt-5 pb-8 mx-auto md:grid-cols-12 lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-15">
        <div class="md:flex md:col-span-7">
            <div class="mr-auto place-self-center">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-3xl xl:text-6xl">
                    Building digital <br>products & brands.
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">
                    This Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt
                    ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi
                    ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse
                    cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa
                    qui
                    officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class="md:mt-0 md:col-span-5">
            <img class="w-full h-auto" src="./images/hero.png" alt="hero image">
        </div>
    </div>
@endsection
