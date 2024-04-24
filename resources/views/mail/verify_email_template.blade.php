@component('mail::message')
    <p>
        Halo <b>{{ $details['first_name'] }} {{ $details['first_name'] }}</b>
    </p>
    <p>
        Terima kasih sudah melakukan registrasi pada Learning Management System <b>MicroTika</b>.
        Silakan Lakukan Verifikasi Email dengan klik tombol di bawah
    </p>
    @component('mail::button', ['url' => 'http://127.0.0.1:8000/register/' . $details['key']])
        Verification
    @endcomponent
@endcomponent
