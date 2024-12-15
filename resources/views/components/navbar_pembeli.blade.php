<x-navbar>
    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
    <x-nav-link href="{{ route('MelihatHargaPasar') }}" :active="request()->is('')">Harga Pasar</x-nav-link>
    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
    <x-nav-link href="{{ route('DafPesananPembeli') }}" :active="request()->is('pembeli/DafPesananPembeli')">Pesanan</x-nav-link>
    <x-nav-dropdown>
        <x-slot:title>Lainnya</x-slot:title>
        <x-slot:icon>
            <span class="absolute top-1 right-0 transform translate-x-1/2 -translate-y-1/2 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
            </span>
        </x-slot:icon>
        <x-dropdown-list href="/chat" :active="request()->is('chat')">Chat</x-dropdown-list>
        <x-dropdown-list href="/laporan/sistem" :active="request()->is('laporan-sistem')">Laporan</x-dropdown-list>
    </x-nav-dropdown>
</x-navbar>
