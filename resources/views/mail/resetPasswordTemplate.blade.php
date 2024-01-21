{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Reset Password</title>
</head>
<body>
    <p>
        Halo
    </p> 

    <center>
        <h3>Silahkan klik tombol dibawah ini untuk melakukan me reet password</h3>

        <a href="{{ $details['url'] }}">ResetPassword</a>
        <p>{{ $details['url'] }}</p>
    </center>
    <p>
        Terima kasih 
    </p>
</body>
</html> --}}

@component('mail::message')
    <p>
        <b> Hello !!</b>
    </p>
    <p>
        Your are receiving this email because we received a password reset request for your account
    </p>

    @component('mail::button', ['url' => 'http://127.0.0.1:8000/reset/' . $details['key']])
        Reset Password
    @endcomponent

    Thanks, <br>
    MyEdu

@endcomponent
