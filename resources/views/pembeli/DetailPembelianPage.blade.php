<x-layout>
    <x-slot:title>Pembayaran Product-Bertani.com</x-slot:title>

    <div class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Detail Pembelian</h1>
    </div>

    <div class="border border-gray-300 max-w-4xl mx-auto mt-10 bg-white p-6">
        <div class="flex grid-cols-2 lg:flex-row gap-x-10">
            <div class="flex-shrink-0 pr-16">
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

    <div class="px-8 py-4 font-libre-franklin font-semibold flex justify-between items-center">

    <button onclick="showPopup('chat')" type="button" id="chat" class="inline-flex px-4 py-2 bg-white rounded-lg border border-black gap-x-2 shadow hover:shadow-md transition-shadow hover:bg-green-500">
    <img src="/img/chat.png" alt="icon_chat" class="w-5 h-5">Chat</button>

    <button onclick="showPopup('batalkanPesanan')" type="button" id="batalkanPesanan" class="inline-flex px-4 py-2 bg-white rounded-lg border border-black  shadow hover:shadow-md transition-shadow hover:bg-red-500">
        Batalkan Pesanan
    </button>

    </div>

  </div>
</x-layout>