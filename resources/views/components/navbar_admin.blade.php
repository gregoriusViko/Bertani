<x-navbar>
    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
    <x-nav-link href="/admin/laporan" :active="request()->is('admin/laporan')">Laporan</x-nav-link>
    <x-nav-link href="{{route('admin.HargaPasar')}}" :active="request()->is('')">Harga Pasar</x-nav-link>
    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
    <x-nav-link href="/admin/delete-akun" :active="request()->is('admin/delete-akun')">Hapus Akun</x-nav-link>
</x-navbar>

