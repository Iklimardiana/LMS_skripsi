<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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

                    } else {
                        swal("Data Anda aman!");
                    }
                });
        }
    </script>

    <script>
        function redirectToAddTeacher() {
            window.location.href = '/admin/teacher/create';
        }

        function redirectToListTeacher() {
            window.location.href = '/admin/teacher'
        }

        function redirectToAddSubject() {
            window.location.href = '/admin/subject/create'
        }

        function redirectToMaterial(idSubject, userRole) {
            if (userRole === 'student') {
                var baseUrl = '/student/materials/';
            } else if (userRole === 'teacher') {
                var baseUrl = '/teacher/materials/';
            }
            var materialUrl = baseUrl + idSubject;
            window.location.href = materialUrl;
        }

        function redirectToAttachmentStudent(idMaterial) {
            var baseUrl = '/teacher/attachment/';
            var attachmentUrl = baseUrl + idMaterial
            window.location.href = attachmentUrl;
        }

        function redirectToStudent(subjectId) {
            var baseUrl = '/teacher/subject/';
            var studentUrl = baseUrl + subjectId + '/student';
            window.location.href = studentUrl;
        }

        function redirectToEditProfile(userId, userRole) {
            if (userRole == 'student') {
                baseUrl = '/student/profile/';
            } else if (userRole == 'teacher') {
                baseUrl = '/teacher/profile/';
            }

            var editProfileUrl = baseUrl + userId + '/edit';
            window.location.href = editProfileUrl;
        }

        function goBack() {
            window.history.back();
        }

        function redirectToProfile(userId, userRole) {
            if (userRole == 'student') {
                baseUrl = '/student/profile/';
            } else if (userRole == 'teacher') {
                baseUrl = '/teacher/profile/';
            }

            var editProfileUrl = baseUrl + userId;
            window.location.href = editProfileUrl;
        }

        function redirectToLink(link) {
            window.open(link, '_blank');
        }

        function redirectToAddAssignment(idMaterial) {
            var baseUrl = '/teacher/';
            var addAssignmentUrl = baseUrl + idMaterial + '/assignment/create/';
            window.location.href = addAssignmentUrl;
        }

        function redirectToEditAssignment(idAssignment) {
            var baseUrl = '/teacher/assignment/';
            var editAssignmentUrl = baseUrl + idAssignment + '/edit';
            window.location.href = editAssignmentUrl;
        }

        function redirectToAddMaterial(idSubject) {
            var baseUrl = '/teacher/materials/create/';
            var addMateriUrl = baseUrl + idSubject;
            window.location.href = addMateriUrl;
        }

        function redirectToEditMaterial(idMaterial) {
            var baseUrl = '/teacher/materials/';
            var EditMateriUrl = baseUrl + idMaterial + '/edit';
            window.location.href = EditMateriUrl;
        }

        function redirectToShowMaterial(idMaterial) {
            var baseUrl = '/teacher/materials/';
            var showMateriUrl = baseUrl + idMaterial + '/detail';
            window.location.href = showMateriUrl;
        }

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
