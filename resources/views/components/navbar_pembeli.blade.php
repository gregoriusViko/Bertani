<x-navbar>
    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
    <x-nav-link href="{{ route('MelihatHargaPasar') }}" :active="request()->is('melihat-harga-pasar')">Harga Pasar</x-nav-link>
    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
    <x-nav-link href="{{ route('DafPesananPembeli') }}" :active="request()->is('pembeli/DafPesananPembeli')">Pesanan</x-nav-link>
    <x-nav-dropdown>
        <x-slot:title>Lainnya</x-slot:title>
        <x-slot:icon>
            <span id="notif-chat" class="absolute top-1 right-0 transform translate-x-1/2 -translate-y-1/2 flex h-2 w-2"
                style="visibility: hidden;">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
        </x-slot:icon>
        <x-dropdown-list href="/chat" :active="request()->is('chat')">Chat
            <div id="jumlah-chat"
                class="inline-block ml-2 bg-green-500 text-white text-xs font-bold px-1 py-1 rounded-full min-w-[20px] text-center justify-center"
                style="visibility: hidden;">0</div>
        </x-dropdown-list>
        <x-dropdown-list href="/laporan/sistem" :active="request()->is('laporan-sistem')">Laporan</x-dropdown-list>
        @if (Auth::guard('buyer')->check())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let notifChat = document.getElementById('notif-chat');
                    let jumlahChat = document.getElementById('jumlah-chat');
                    axios.get("{{ route('sum-of-chat') }}").then((response) => {
                        console.log(response.data);
                        if (response.data > 0) {
                            notifChat.style.visibility = "visible";
                            jumlahChat.style.visibility = "visible";
                            jumlahChat.innerHTML = response.data;
                        }
                    });
                    Echo.private(`chat.buyer.{{ Auth::guard('buyer')->user()->slug }}`)
                    .listen("MessageSent", (response) => {
                        if('{{ route('chat') }}'+'/'+response['sender'] !== window.location.href){
                            notifChat.style.visibility = "visible";
                            jumlahChat.style.visibility = "visible";
                            jumlahChat.innerHTML = parseInt(jumlahChat.innerHTML) + 1;
                        }
                    });
                });
            </script>
        @endif
    </x-nav-dropdown>
</x-navbar>
