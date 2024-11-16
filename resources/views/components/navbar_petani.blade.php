<x-navbar>
    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
    <x-nav-link href="/hargapasar" :active="request()->is('hargapasar')">Harga Pasar</x-nav-link>
    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
    <x-nav-dropdown>
        <x-slot:title>Toko</x-slot:title>
        <x-dropdown-list href="/dafproduk" :active="request()->is('dafproduk')">Daftar Produk</x-dropdown-list>
        <x-dropdown-list href="/dafpesanan" :active="request()->is('dafpesanan')">Daftar Pesanan</x-dropdown-list>
        <x-dropdown-list href="/lapPen" :active="request()->is('lapPen')">Laporan Penjualan</x-dropdown-list>
    </x-nav-dropdown>
    <x-nav-dropdown>
        <x-slot:title>Lainnya</x-slot:title>
        <x-dropdown-list href="/chat" :active="request()->is('chat')">Chat</x-dropdown-list>
        <x-dropdown-list href="/laporan-petani" :active="request()->is('laporan-petani')">Laporan</x-dropdown-list>
    </x-nav-dropdown>
</x-navbar>