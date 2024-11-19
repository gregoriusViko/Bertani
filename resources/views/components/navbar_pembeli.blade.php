<x-navbar>
    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
    <x-nav-link href="/hargapasar" :active="request()->is('hargapasar')">Harga Pasar</x-nav-link>
    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
    <x-nav-link href="/pembeli/pesanan" :active="request()->is('pesanan')">Pesanan</x-nav-link>
    <x-nav-dropdown>
        <x-slot:title>Lainnya</x-slot:title>
        <x-dropdown-list href="/chat" :active="request()->is('chat')">Chat</x-dropdown-list>
        <x-dropdown-list href="/laporan-sistem" :active="request()->is('laporan-sistem')">Laporan</x-dropdown-list>
    </x-nav-dropdown>
</x-navbar>
