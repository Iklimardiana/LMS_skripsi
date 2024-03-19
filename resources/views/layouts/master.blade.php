<!DOCTYPE html>
<html lang="en" class="!scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/logo.webp" type="image/x-icon">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/ckeditor5-build-classic-with-image-resize@12.4.0/build/ckeditor.min.js">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
    @include('partials.nav')
    @auth
        @include('partials.aside')
    @endauth
    <main>
        <section class="w-full mt-16 bg-white">
            @yield('content')
        </section>
    </main>
    @include('partials.footer')
    @stack('scripts')

    {{-- sweetAlert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        const deleteData = (event, url, elementId) => {
            event.preventDefault();
            swal({
                    title: "Anda yakin akan menghapusnya?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Data Anda telah dihapus!", {
                            icon: "success",
                        });
                        setTimeout(() => {
                            fetch(url, {
                                    method: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    }
                                })
                                .then(response => {
                                    const elementToRemove = document.getElementById(elementId);
                                    if (elementToRemove) {
                                        elementToRemove.remove();
                                    }
                                    location.reload()
                                })
                                .catch(error => {
                                    // 
                                });
                        }, 100);

                    } else {
                        swal("Data Anda aman!");
                    }
                });
        }
    </script>
    <script>
        function previewAssignment(typeAssignment, attachment, roleUser) {
            if (typeAssignment === "file" && roleUser == 'teacher') {
                window.open('{{ asset('/attachment/task/') }}' + '/' + attachment, '_blank');
            } else if (typeAssignment === "file" && roleUser == 'student') {
                window.open('{{ asset('/attachment/submission/') }}' + '/' + attachment, '_blank');
            } else {
                window.open(attachment, '_blank');
            }
        }
    </script>
</body>

</html>
