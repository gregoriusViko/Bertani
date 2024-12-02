<x-layout>
    <x-slot:title>Daftar Pesanan-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mb-4 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-libre-franklin font-bold tracking-tight text-gray-900">Daftar Pesanan</h1>
        </div>
    </div>
    @foreach ($orders as $order)
        <!-- bawah ini adalah component untuk produk -->
        <div id="cardContainer"
            class="mx-auto m2ax-w-7xl px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6 md:gap-2 lg:gap-6">

            <div {{-- hover:scale-105 transition-transform duration-300 ease-in-ou --}}
                class="m-3 t shadow-lg border rounded-lg p-4 sm:px-6 md:px-7 lg:px-8 grid sm:grid-cols-10 md:grid-cols-11 lg:grid-cols-10 gap-2 md:gap-6 lg:gap-6">
                <!-- Gambar Produk -->
                <div
                    class="col-start-1 row-start-1 col-span-11  md:col-span-3 md:row-span-4 lg:col-span-3 lg:row-span-4 rounded-lg flex justify-center items-center border overflow-hidden">
                    <img src="{{ $order->product->img_link }}" alt="hasil_tani"
                        class="thumbnail md:w-full md:h-full lg:w-full lg:h-full w-1/2 h-1/2 object-cover md:object-fill">
                    {{-- <img src="{{ $order->product->img_link }}" alt="profile"
                        class="thumbnail md:w-full md:h-full lg:w-full lg:h-full w-1/2 h-1/2 object-contain"> --}}
                </div>
                <!-- Nama Produk -->
                <div
                    class="capitalize font-libre-franklin text-base md:text-lg lg:text-xl font-semibold row-start-3 col-span-8 col-start-1 md:col-start-4 md:row-start-1 md:col-span-4 lg:col-start-4 lg:row-start-1 lg:col-span-4 ">
                    {{ $order->product->type->name }}
                </div>
                <div
                    class="font-libre-franklin text-xs md:text-sm lg:text-base font-light row-start-2 col-span-8 col-start-1 md:col-start-8 md:row-start-1 md:col-span-4 md:flex md:justify-end ">
                    <h4 class="text-sm">"dd-mm-yyyy - 13.20 WIB"</h4>
                </div>
                <!-- namapembeli -->
                <div
                    class="font-libre-franklin text-sm md:text-base lg:text-lg font-normal row-start-4 col-span-8 col-start-1 md:col-start-4 md:row-start-2 md:col-span-4 lg:col-start-4 lg:row-start-2 lg:col-span-4 ">
                    {{ $order->buyer->email }} <br> {{ $order->buyer->phone_number }}
                </div>

                <div
                    class="font-libre-franklin text-lg md:text-lg lg:text-2xl font-semibold row-start-5 col-span-8 col-start-1 md:row-start-2 md:col-start-8 md:col-span-4 md:flex md:justify-end">
                    <h2>{{ Number::currency($order->price, in: 'idr') }}</h2>
                </div>

                <!-- metode pembayaran -->
                <div
                    class="font-libre-franklin text-sm md:text-base lg:text-lg font-normal row-start-6 col-span-5 col-start-1 md:row-start-3 md:col-start-4 md:col-span-4">
                    @if ($order->payment_proof == 'transfer')
                        <h4 class="font-libre-franklin font-normal">Transfer</h4>
                    @else
                        <h4 class="font-libre-franklin font-normal">COD</h4>
                    @endif
                    {{-- <h4 class="font-libre-franklin font-normal">{{ $order->payment_proof }}</h4> --}}
                    @if ($order->payment_proof == 'transfer')
                        <button
                            class="bg-blue-500 rounded-md p-1 flex items-center text-white font-libre-franklin font-light text-sm hover:bg-blue-900 transition ease-in duration-100"
                            onclick="showTFModal()">
                            <ion-icon name="document-outline" class="mr-2"></ion-icon>
                            <span class="mt-0.5">Bukti Transfer</span>
                        </button>
                    @endif

                </div>

                <div
                    class="font-libre-franklin font-normal row-start-6 col-span-6 col-start-6 md:row-start-3 md:col-start-9 md:col-span-3 md:row-span-2 ">
                    @if ($order->order_status == 'menunggu konfirmasi')
                        <h4 class="bg-yellow-200 text-sm rounded-md p-1 mb-1 flex justify-center relative">
                            Butuh Konfirmasi
                            <span
                                class="absolute top-1 right-0 transform translate-x-1/2 -translate-y-1/2 flex h-3 w-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                        </h4>
                        <div class="flex justify-center">
                            <button class="hover:text-red-500 " onclick="showDecline()"><ion-icon
                                    name="close-circle-outline"
                                    class="transition ease-in duration-100 text-3xl"></ion-icon></button>
                            <button class="hover:text-green-500" onclick="showACC()"><ion-icon
                                    name="checkmark-circle-outline"
                                    class="transition ease-in duration-100 text-3xl"></ion-icon></button>
                        </div>
                    @elseif ($order->order_status == 'permintaan diterima')
                        <h4 class="bg-[#00D120] text-sm rounded-md p-1 mb-1 flex justify-center">Pesanan Diterima</h4>
                    @elseif ($order->order_status == 'selesai')
                        <h4 class="bg-[#00D115] text-sm rounded-md p-1 mb-1 flex justify-center">Pesanan Selesai</h4>
                    @elseif ($order->order_status == 'ditolak')
                        <h4 class="bg-[#f44747] text-sm rounded-md p-1 mb-1 flex justify-center">Pesanan Ditolak</h4>
                    @else
                        <h4 class="bg-[#FF0000] text-sm rounded-md p-1 mb-1 flex justify-center">Pesanan Dibatalkan</h4>
                    @endif
                    <!-- Tombol Aksi -->
                    {{-- <div class="flex justify-center">
                        <button class="hover:text-red-500 " onclick="showACC()"><ion-icon name="close-circle-outline"
                                class="transition ease-in duration-100 text-3xl"></ion-icon></button>
                        <button class="hover:text-green-500" onclick="showDecline()"><ion-icon name="checkmark-circle-outline"
                                class="transition ease-in duration-100 text-3xl"></ion-icon></button>
                    </div> --}}
                </div>
            </div>

        </div>
    @endforeach

    {{-- modal bukti tf --}}
    <x-modal id="showTF-modal">
        <div class="text-sm md:text-lg font-libre-franklin font-medium">Bukti Transfer</div>
        <div class="flex justify-center">
            <img class="md:h-80" src="\img\cthBuktiTF.png" alt="bukti">
        </div>
        <div class="text-sm md:text-base font-libre-franklin font-bold">
            <p class="text-sm md:text-base">Mohon cek rekening anda sebelum melakukan konfirmasi pesanan.</p>
            <p class="text-sm md:text-base">Laporkan jika terjadi penipuan. <a href=""
                    class="hover:underline hover:text-red-500 text-sm md:text-base">Disini</a></p>
        </div>
        <div class="mt-4 flex justify-end space-x-2">
            <button class="bg-red-600 text-white px-4 py-1 rounded-lg hover:bg-gray-400"
                onclick="closeModal('showTF-modal')">
                TUTUP
            </button>
        </div>
    </x-modal>

    {{-- modal terima konfirmasi pesanan --}}
    <x-modal id="showACC-modal">
        <div class="grid grid-flow-row">
            <div class="text-xl">Konfirmasi Pesanan</div>
            <div class="text-base">Nama Produk - xx kg</div>
            <div class="text-base">Nama Pembeli - No Telp</div>
            <div class="text-base">Metode Pembayaran</div>
            <div class="text-xl">Rp xx.xxx</div>
            <div class="mt-4 flex justify-end space-x-2">
                <button
                    class="border border-black bg-white text-black px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-red-400"
                    onclick="closeModal('showACC-modal')">
                    TUTUP
                </button>
                {{-- jika di klik setuju, maka status berubah pesanan siap --}}
                <button
                    class="border border-black bg-green-600 text-white px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-green-400"
                    onclick="setujuTerima('showACC-modal')">
                    SETUJU
                </button>
            </div>
        </div>
    </x-modal>
    <x-modal id="showDecline-modal">
        <div class="grid grid-flow-row">
            <div class="text-xl">Konfirmasi Pesanan</div>
            <div class="text-lg">Yakin anda menolak pesanan</div>
            <div class="mt-4 flex justify-end space-x-2">
                <button
                    class="bg-red-600 text-white px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-red-400"
                    onclick="closeModal('showDecline-modal')">
                    TIDAK
                </button>
                {{-- jika di klik setuju, maka status berubah pesanan siap --}}
                <button
                    class=" bg-blue-600 text-white px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-blue-400"
                    onclick="setujuTolak('showDecline-modal')">
                    YA
                </button>
            </div>
        </div>
    </x-modal>
    


    {{-- <div id="componentContainer" class="hidden mt-4">
        @include('components.delete_confirm')
    </div> --}}

    <script>
        function toggleComponent() {
            const container = document.getElementById('componentContainer');
            container.classList.toggle('hidden');
        }

        function showTFModal() {
            const modal = document.getElementById('showTF-modal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function showDecline() {
            const modal = document.getElementById('showDecline-modal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function showACC() {
            const modal = document.getElementById('showACC-modal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function setujuTerima() {
            const modal = document.getElementById('showACC-modal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
</x-layout>
