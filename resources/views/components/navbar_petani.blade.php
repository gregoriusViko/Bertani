<x-navbar>
    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
    <x-nav-link href="{{ route('MelihatHargaPasar') }}" :active="request()->is('')">Harga Pasar</x-nav-link>
    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
    <x-nav-dropdown>
        <x-slot:title>Toko</x-slot:title>
        <x-dropdown-list href="{{ route('dafproduk') }}" :active="request()->is('petani/dafproduk')">Daftar Produk</x-dropdown-list>
        <x-dropdown-list href="{{ route('dafpesanan') }}" :active="request()->is('petani/dafpesanan')">Daftar Pesanan</x-dropdown-list>
        <x-dropdown-list href="{{ route('lapPen') }}" :active="request()->is('petani/lapPen')">Laporan Penjualan</x-dropdown-list>
    </x-nav-dropdown>
    <x-nav-dropdown>
        <x-slot:icon>
            <span class="absolute top-1 right-0 transform translate-x-1/2 -translate-y-1/2 flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
            
            <script>
                
            </script>
        </x-slot:icon>
        <x-slot:title>Lainnya</x-slot:title>
        <x-dropdown-list href="/chat" :active="request()->is('chat')">Chat</x-dropdown-list>
        <x-dropdown-list href="/laporan/sistem" :active="request()->is('laporan-sistem')">Laporan</x-dropdown-list>
    </x-nav-dropdown>
</x-navbar>