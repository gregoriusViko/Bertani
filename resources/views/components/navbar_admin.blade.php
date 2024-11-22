<x-navbar>
    <x-nav-link href="/admin/laporan" :active="request()->is('admin/laporan')">Laporan</x-nav-link>
    <x-nav-link href="#" :active="request()->is('')">Harga Pasar</x-nav-link>
    <x-nav-link href="/admin/delete-akun" :active="request()->is('')">Hapus Akun</x-nav-link>
</x-navbar>

