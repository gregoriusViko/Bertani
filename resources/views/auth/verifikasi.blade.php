<x-layout>
    <x-slot:title>Verifikasi</x-slot:title>
    Pengguna diwajibkan verifikasi
    <form action="/email/verification-notification" method="post">
        @csrf
        <button type="submit">Kirim ulang</button>
    </form>
    <h1>Ganti email</h1>
    <form action="post" method="post">
        <input type="text">
    </form>
</x-layout>