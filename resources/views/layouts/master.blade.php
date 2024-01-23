<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        function redirectToMaterial() {
            window.location.href = '#';
        }

        function redirectToExam() {
            window.location.href = 'exam_list.html'
        }

        function redirectToStudent(subjectId) {
            var baseUrl = '/teacher/subject/';
            var studentUrl = baseUrl + subjectId + '/student';
            window.location.href = studentUrl;
        }
    </script>
</body>

</html>
