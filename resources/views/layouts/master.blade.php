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

        function redirectToMaterial(idSubject) {
            var baseUrl = '/teacher/materials/';
            var materialUrl = baseUrl + idSubject;
            window.location.href = materialUrl;
        }

        function redirectToAttachmentStudent(idMaterial) {
            var baseUrl = '/teacher/attachment/';
            var attachmentUrl = baseUrl + idMaterial
            window.location.href = attachmentUrl;
        }

        function redirectToExam() {
            window.location.href = 'exam_list.html'
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

        function redirectListMaterials(idSubject) {
            var baseUrl = '/teacher/materials/';
            var ListMateriUrl = baseUrl + idSubject;
            window.location.href = ListMateriUrl;
        }

        function redirectToEditMaterial(idMaterial) {
            var baseUrl = '/teacher/materials/';
            var EditMateriUrl = baseUrl + idMaterial + '/edit';
            window.location.href = EditMateriUrl;
        }
    </script>
</body>

</html>
