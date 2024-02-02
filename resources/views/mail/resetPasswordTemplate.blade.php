@component('mail::message')
    <p>
        Halo
    </p>
    <p>
        Kamu menerima email ini karena kamu akan melakukan reset kata sandi. Klik tombol di bawah ini untuk melakukan reset
        kata sandi.
    </p>
    @component('mail::button', ['url' => 'http://127.0.0.1:8000/reset/' . $details['key']])
        Verification
    @endcomponent
@endcomponent
