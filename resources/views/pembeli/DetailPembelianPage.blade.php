<x-layout>
    <x-slot:title>Pembayaran Product-Bertani.com</x-slot:title>

    <div class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-2 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Detail Pembelian</h1>
        <a href="{{ route('PemDafPesananPage') }}">
            <button onclick="kembali" type="button" id="batalkanPesanan" class="inline-flex px-4 py-2 bg-white rounded-lg border border-black shadow hover:shadow-md transition-shadow hover:bg-yellow-500 hover:border-opacity-10 sm:w-auto mt-2 sm:mt-0">
                Kembali
            </button>
        </a>
        
    </div>

    <div class="border border-gray-300 max-w-4xl mx-auto mt-8 bg-white p-6 rounded-lg">
        <div class="flex flex-col grid-cols-2 md:flex-row gap-x-10">
            <div class="flex-shrink-0 md:pr-16">
                <p class="text-xl md:text-2xl font-libre-franklin font-bold tracking-tight text-gray-900 py-2">Jagung Manis</p>
                <img src="/img/jagung.jpeg" alt="Jagung" class="w-40 h-48 object-cover rounded-md shadow-md py-12"/>
                    
                <p class="text-base md:text-lg font-libre-franklin font-bold tracking-tight text-gray-900 py-2">Petani</p>
                <p class="text-base md:text-lg font-libre-franklin italic tracking-tight text-gray-900">Ari Muhammad</p>
                <p class="text-base md:text-lg font-libre-franklin italic tracking-tight text-gray-900">08123456789</p>
            </div>

            <div class="flex-1">
                <div class="grid lg:grid-cols-2 gap-x-10 gap-y-8 py-2 text-lg md:text-lg font-libre-franklin tracking-tight text-gray-900 max-w-md">
                    <div>
                        <p class="font-bold">Nomor Pembelian</p>
                        <p class="italic">123904</p>
                    </div>
                    <div>
                        <p class="font-bold">Tanggal Pembelian</p>
                        <p class="italic">2 Oktober 2024</p>
                    </div>
                    <div>
                        <p class="font-bold">Jenis Produk</p>
                        <p class="italic">Buah</p>
                    </div>
                    <div>
                        <p class="font-bold">Status</p>
                        <p class="italic">Menunggu konfirmasi</p>
                    </div>
                    <div>
                        <p class="font-bold">Jumlah Beli</p>
                        <p class="italic">1</p>
                    </div>
                    <div>
                        <p class="font-bold">Metode Pembayaran</p>
                        <p class="italic">Cash</p>
                    </div>
                    <div>
                        <p class="font-bold">Harga</p>
                        <p class="italic">Rp 250.000</p>
                    </div>
                    <div>
                        <p class="font-bold whitespace-nowrap">Alamat Pengambilan Barang</p>
                        <p class="italic whitespace-normal">Dusun Mojosawit, Kelurahan Tawangharjo, Kecamatan Giriwoyo
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-8 py-4 font-libre-franklin font-semibold flex flex-col items-center space-y-4 sm:space-y-0 sm:flex-row sm:justify-between sm:items-center">
        <button onclick="" type="button" id="chat" class="inline-flex px-4 py-2 bg-white rounded-lg border border-black gap-x-2 shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-green-500 sm:w-auto">
            <img src="/img/chat.png" alt="icon_chat" class="w-5 h-5">Chat
        </button>

        <button onclick="showPopup('batalkanPesanan')" type="button" id="batalkanPesanan" class="inline-flex px-4 py-2 bg-white rounded-lg border border-black shadow hover:shadow-md hover:border-opacity-10 transition-shadow hover:bg-red-500 sm:w-auto mt-2 sm:mt-0">
            Batalkan Pesanan
        </button>
    </div>


    <div id="popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full flex flex-col items-center gap-6 gap-x-10">
            <h2 class="text-xl font-semibold mb-4">Pembatalan Pesanan</h2>
            <p class="text-sm">Tuliskan keterangan alasan pembatalan</p>
            <textarea id="batalkanPesanan" class="w-full border border-gray-500 rounded-lg p-2 mb-4 resize-none" rows="4" placeholder=""></textarea>
            <div class="flex justify-end gap-4">
                <button onclick="closePopup()" class="border border-black inline-flex px-4 py-2 bg-white rounded-lg gap-x-2 hover:bg-gray-200">
                <img src="/img/laporanbatal.png" alt="batalkanPesanan" class="w-5 h-5">BATAL</button>
                <button onclick="kirimPembatalan()" class="border border-black inline-flex px-4 py-2 bg-white rounded-lg gap-x-2 hover:bg-gray-200">
                <img src="/img/paperplane.png" alt="batalkanPesanan" class="w-5 h-5">KIRIM</button>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan popup berdasarkan ID
        function showPopup() {
            document.getElementById('popup').classList.remove("hidden");
        }

        // Fungsi untuk menutup popup berdasarkan ID
        function closePopup() {
            document.getElementById('popup').classList.add("hidden");
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