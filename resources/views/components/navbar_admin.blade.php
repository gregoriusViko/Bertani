<x-navbar>
    <x-nav-link href="{{ route('admin.laporan') }}" :active="request()->is('admin/laporan')">Laporan</x-nav-link>
    <x-nav-link href="#" :active="request()->is('')">Harga Pasar</x-nav-link>
    <x-nav-link href="#" :active="request()->is('')">Hapus Akun</x-nav-link>
</x-navbar>

