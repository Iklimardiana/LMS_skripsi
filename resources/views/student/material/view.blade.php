@extends('layouts.master')
@section('title')
    Learning Page
@endsection
@section('content')
    <div class="p-4 mt-16">
        <div
            class="w-full flex flex-col md:flex-row p-4 gap-2 border-2 border-gray-200 border-dashed h-auto mb-20 rounded-lg min-h-100">
            <div class="overflow-x-auto h-auto md:min-w-80 z-30 p-2 rounded-sm bg-cyan-50 border border-cyan-500 text-start">
                <a href="subject.html">
                    <svg class="w-6 h-6 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
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
                            <th class="border bg-cyan-200 border-cyan-500 py-1 font-bold text-gray-900 whitespace-nowrap">
                                Tugas
                            </th>
                            <th class="bg-cyan-200 py-1 font-bold text-gray-900 whitespace-nowrap">Unggah
                                File Tugas
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-50 border border-cyan-500 text-center">
                            <th class="border border-cyan-500 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <button>
                                        <svg class="w-8 h-8 text-cyan-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                            <path
                                                d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                            <path
                                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <form class="flex items-center justify-center">
                                    <label for="assignment">
                                        <input type="file" name="assignment" id="file_input"
                                            class="block w-21 text-sm text-gray-900 border border-cyan-400 rounded-lg cursor-pointer bg-cyan-500 focus:outline-none"
                                            aria-describedby="file_input_help">
                                    </label>
                                </form>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <table class="mt-3 overflow-x-auto text-sm text-left rtl:text-right text-gray-500 w-full">
                    <thead class="text-xs text-center text-white uppercase bg-cyan-500 border border-cyan-500">
                        <tr>
                            <th colspan="2" class="p-2">Lampiran Tugas Anda</th>
                        </tr>
                    </thead>
                    <thead class="border">
                        <tr class="odd:bg-white even:bg-gray-50 border border-cyan-500 text-center">
                            <th class="border bg-cyan-200 border-cyan-500 py-1 font-bold text-gray-900 whitespace-nowrap">
                                Tugas
                            </th>
                            <th class="bg-cyan-200 py-1 font-bold text-gray-900 whitespace-nowrap">Nilai
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-50 border border-cyan-500 text-center">
                            <th class="border border-cyan-500 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <button>
                                        <svg class="w-8 h-8 text-cyan-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                            <path
                                                d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                            <path
                                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                90
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col w-full">
                <div class="flex flex-col w-full border border-cyan-500 p-3 bg-cyan-50 mt-2 md:mt-0 space-y-2">
                    <div class="flex flex-col min-h-80">
                        <div class="h-auto p-2 rounded-sm bg-white border border-cyan-500 mb-2">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex dignissimos dolores
                                possimus totam nulla repudiandae veritatis, consequatur provident aut voluptatibus
                                quibusdam nam quidem vel officia accusantium porro officiis illo unde odio eaque
                                harum amet? Iure, sapiente non illum id vel cupiditate, voluptatibus libero enim
                                corporis delectus quidem veritatis illo et quisquam quae qui animi laboriosam
                                accusamus quos ut asperiores, architecto sequi voluptatem? Reiciendis odit quia at
                                unde voluptates recusandae minus! Accusantium est nesciunt ad ipsa officiis debitis
                                magnam cumque error ratione, quis architecto doloribus explicabo voluptas laudantium
                                veritatis earum quia in quo illo deleniti! Quod molestiae, ea aspernatur ex error,
                                iusto reiciendis maxime sapiente, sunt eius obcaecati. Cumque, sequi commodi
                                deserunt voluptatibus dolorum aperiam non ducimus, error fugit officiis nemo
                                veritatis nam soluta earum id repellendus quas. Dolor iusto aliquam iure ipsa
                                reiciendis vero blanditiis libero reprehenderit quam accusantium saepe, placeat
                                rerum molestias perferendis. Provident, laboriosam maiores ipsam sed rerum nulla
                                iure fuga aliquid obcaecati dicta, illo illum, quod exercitationem vel autem! Ipsum
                                voluptas provident laudantium ullam facere nesciunt corporis asperiores id
                                blanditiis maiores? Doloremque distinctio officia laborum ratione consequatur
                                similique neque corrupti repellat! Est maxime commodi provident molestiae repellat
                                saepe pariatur reprehenderit quos veritatis fuga animi eius, nisi neque? Possimus,
                                officiis! Minima ea soluta, animi dolor dignissimos qui sint dolorem quas tempore
                                similique natus nulla molestiae tempora laborum doloremque possimus non perspiciatis
                                doloribus quaerat. Maxime odit reiciendis enim, nesciunt odio explicabo fuga
                                deleniti voluptates autem ex, provident, laboriosam animi at incidunt deserunt
                                eveniet accusamus itaque sint error earum eos omnis! Repellat autem a voluptatem
                                reprehenderit ratione perspiciatis ipsam minima nemo? Quas, illo. Natus aspernatur,
                                ullam, veritatis dolor ipsum laudantium dicta eveniet, reiciendis deserunt
                                perferendis vero facere voluptates quasi molestiae voluptatum necessitatibus
                                cupiditate enim velit. Quibusdam, hic. Dicta consequatur incidunt non? Voluptatem
                                distinctio nobis earum eveniet ullam perspiciatis eaque dolores!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-8 mb-2">
                    <ul class="flex justify-between">
                        <li>
                            <a href=""
                                class="border bg-cyan-500 hover:bg-cyan-700 text-white rounded-md p-2">Sebelumnya</a>
                        </li>
                        <li> <a href=""
                                class="border bg-cyan-500 hover:bg-cyan-700 text-white rounded-md p-2">Selanjutnya</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
