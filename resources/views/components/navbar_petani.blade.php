<x-navbar>
    <x-nav-link href="/home" :active="request()->is('home')">Beranda</x-nav-link>
    <x-nav-link href="/hargapasar" :active="request()->is('hargapasar')">Harga Pasar</x-nav-link>
    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
    <x-nav-dropdown>
        <x-slot:title>Toko</x-slot:title>
        <x-dropdown-list href="">Daftar Produk</x-dropdown-list>
        <x-dropdown-list href="">Daftar Pesanan</x-dropdown-list>
        <x-dropdown-list href="">Laporan Penjualan</x-dropdown-list>
    </x-nav-dropdown>
    <x-nav-dropdown>
        <x-slot:title>Lainnya</x-slot:title>
        <x-dropdown-list href="/chat" :active="request()->is('chat')">Chat</x-dropdown-list>
        <x-dropdown-list href="/laporan" :active="request()->is('laporan')">Laporan</x-dropdown-list>
    </x-nav-dropdown>
</x-navbar>