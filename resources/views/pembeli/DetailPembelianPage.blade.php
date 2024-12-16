<x-layout>
    <x-slot:title>Pembayaran Product-Bertani.com</x-slot:title>

    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-2 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Detail Pembelian</h1>
        <div class="flex gap-x-2">

            <a href="{{ route('laporan.form', ['orderId' => $order->id]) }}" id="laporkan"
                class="inline-flex px-4 py-2 bg-white rounded-lg border border-black gap-x-2 shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-red-500 sm:w-auto">
                <img src="/img/laporanlaporkan.png" alt="icon_laporkan" class="w-5 h-5">Laporkan
            </a>

            <a href="{{ route('DafPesananPembeli', ['order' => $order]) }}">
                <button type="button" id="batalkanPesanan"
                    class="inline-flex px-4 py-2 bg-white rounded-lg border border-black shadow hover:shadow-md transition-shadow hover:bg-yellow-500 hover:border-opacity-10 sm:w-auto mt-2 sm:mt-0">
                    Kembali
                </button>
            </a>
        </div>
    </div>

    <div class="border border-gray-300 max-w-4xl mx-auto mt-8 bg-white p-6 rounded-lg">
        <div class="flex flex-col grid-cols-2 md:flex-row gap-x-10">
            <div class="flex-shrink-0 md:pr-16">
                <p id="nameproduk"
                    class="text-xl md:text-2xl font-libre-franklin font-bold tracking-tight text-gray-900 py-2">
                    {{ $order->product->type->name }}</p>
                <img src="{{ $order->product->img_link }}" alt="{{ $order->product->type->name }}" id="gambarproduk"
                    class="w-40 h-48 object-cover rounded-md shadow-md py-12" />

                <p class="text-base md:text-lg font-libre-franklin font-bold tracking-tight text-gray-900 py-2">Petani
                </p>
                <p id="namapetani" class="text-base md:text-lg font-libre-franklin italic tracking-tight text-gray-900">
                    {{ $order->product->farmer->name }}</p>
                <p id="notelp" class="text-base md:text-lg font-libre-franklin italic tracking-tight text-gray-900">
                    {{ $order->product->farmer->phone_number }}</p>
            </div>

            <div class="flex-1">
                <div
                    class="grid lg:grid-cols-2 gap-x-10 gap-y-8 py-2 text-lg md:text-lg font-libre-franklin tracking-tight text-gray-900 max-w-md">
                    <div>
                        <p class="font-bold">Nomor Pembelian</p>
                        <p id="idpembelian" class="italic">{{ $order->receipt_number }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Tanggal Pembelian</p>
                        <p id="tglBeli" class="italic">{{ $order->order_time->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Jenis Produk</p>
                        <p id="jenis" class="italic">{{ $order->product->type->category }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Status</p>
                        <p id="statusnya" class="italic">{{ ucfirst($order->order_status) }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Jumlah Beli</p>
                        <p id="jumbel" class="italic">{{ $order->quantity_kg }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Metode Pembayaran</p>
                        <p id="metodenya" class="italic">{{ $order->payment_proof }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Harga</p>
                        <p id="harga" class="italic">Rp
                            {{ number_format($order->historyPrice->price * $order->quantity_kg, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="font-bold whitespace-nowrap">Alamat Pengambilan Barang</p>
                        <a id="alamatPetani" href="{{ $order->product->farmer->home_address }}" target="_blank">
                            <p class="italic whitespace-normal">{{ $order->product->farmer->home_address }}
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="px-8 py-4 font-libre-franklin font-semibold flex flex-col items-center space-y-4 sm:space-y-0 sm:flex-row sm:justify-between sm:items-center">
        <a href="{{ route('chat', $order->product->farmer->slug) }}">
            <button onclick="button" type="button" id="chat"
                class="inline-flex px-4 py-2 bg-white rounded-lg border border-black gap-x-2 shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-green-500 sm:w-auto">
                <img src="/img/chat.png" alt="icon_chat" class="w-5 h-5">Chat
            </button>
        </a>
        @if ($order->order_status == 'dibatalkan')
            <button onclick="showAlasanA('showDibatalkan')" id="lihatalasanA" type="button"
                class="text-white inline-flex px-4 py-2 bg-[#f44747] rounded-lg border border-black gap-x-2 shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-red-600 sm:w-auto ">Lihat
                Alasan
            </button>
        @elseif($order->order_status == 'ditolak')
            <button onclick="showAlasanB('showDitolak')" id="lihatalasanB" type="button"
                class="text-white inline-flex px-4 py-2 bg-[#f44747] rounded-lg border border-black gap-x-2 shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-red-600 sm:w-auto ">Lihat
                Alasan
            </button>
        @endif


        @if ($order->order_status == 'menunggu konfirmasi')
            <button onclick="showPopup('batalkanPesanan')" type="button" id="batalkanPesanan"
                class="inline-flex px-4 py-2 bg-white rounded-lg border border-black shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-red-500 sm:w-auto mt-2 sm:mt-0">
                Batalkan Pesanan
            </button>
        @endif

        @if ($order->order_status == 'pesanan diterima')
            <a href="{{ route('order.showPaymentPage', ['orderId' => $order->id]) }}"
                class="inline-flex px-4 py-2 bg-white rounded-lg border border-black shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-blue-500 sm:w-auto mt-2 sm:mt-0">
                Pembayaran
            </a>
        @endif
    </div>


    <div id="popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full flex flex-col items-center gap-6 gap-x-10">
            <h2 class="text-xl font-semibold mb-4">Pembatalan Pesanan</h2>
            <p class="text-sm">Tuliskan keterangan alasan pembatalan</p>
            <form action="{{ route('order.cancel', $order->receipt_number) }}" method="POST">
                @csrf
                @method('PATCH')
                <textarea id="cancellation_reason" name="cancellation_reason"
                    class="w-full border border-gray-500 rounded-lg p-2 mb-4 resize-none" rows="4"
                    placeholder="Masukkan alasan pembatalan"></textarea>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closePopup()"
                       id="tutup" class="border border-black inline-flex px-4 py-2 bg-white rounded-lg gap-x-2 hover:bg-gray-200">
                        <img src="/img/laporanbatal.png" alt="batalkanPesanan" class="w-5 h-5">BATAL</button>
                    <button type="submit"
                        id="kirim" class="border border-black inline-flex px-4 py-2 bg-white rounded-lg gap-x-2 hover:bg-gray-200">
                        <img src="/img/paperplane.png" alt="batalkanPesanan" class="w-5 h-5">KIRIM</button>
                </div>
            </form>
        </div>
    </div>

    <x-Modal id="showDibatalkan" class="hidden">
        <div class="grid grid-flow-row">
            <div class="text-xl font-bold mb-4">Alasan Pembatalan</div>
            <div class="border border-black rounded-md p-2 h-24 scroll-auto">
                <h3 id="alasandibatal">{{ $order->cancellation_reason }}</h3>
            </div>
            <div class="mt-4">
                <button type="button" class="bg-gray-400 px-2 py-1 rounded-md hover:bg-gray-700 hover:text-white"
                    id="closeA" onclick="closeModal('showDibatalkan')">TUTUP</button>
            </div>
        </div>
    </x-Modal>

    <x-Modal id="showDitolak" class="hidden">
        <div class="grid grid-flow-row">
            <div class="text-xl font-bold mb-4">Alasan Pembatalan</div>
            <div class="border border-black rounded-md p-2 h-24 scroll-auto">
                <h3 id="alasanditolak">{{ $order->cancellation_reason }}</h3>
            </div>
            <div class="mt-4">
                <button type="button" class="bg-gray-400 px-2 py-1 rounded-md hover:bg-gray-700 hover:text-white"
                    id="closeB" onclick="closeModal('showDitolak')">TUTUP</button>
            </div>
        </div>
    </x-Modal>


    <script>
        // Fungsi untuk menampilkan popup berdasarkan ID
        function showPopup() {
            document.getElementById('popup').classList.remove("hidden");
        }

        function showAlasanA() {
            document.getElementById('showDibatalkan').classList.remove("hidden");
        }

        function showAlasanB() {
            document.getElementById('showDitolak').classList.remove("hidden");
        }

        // Fungsi untuk menutup popup berdasarkan ID
        function closePopup() {
            document.getElementById('popup').classList.add("hidden");
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                // body.style.overflow = '';
            }
        }

        // Confirm cancellation and update the status (masih belum bisa)
        // function kirimPembatalan() {
        //     const alasanBatal = document.getElementById('batalkanPesanan').value.trim();
        //     if (alasanBatal.trim() === '') {
        //         alert('Isi alasan pembatalan!');
        //         return;
        //     }
        //     document.getElementById('statusPesanan').innerText = 'Menunggu respon petani';
        //     closePopup();
        // }
    </script>
</x-layout>
