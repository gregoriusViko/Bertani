<x-layout>
    <x-slot:title>Daftar Pesanan-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mb-4 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-libre-franklin font-bold tracking-tight text-gray-900">Daftar Pesanan</h1>
        </div>
    </div>
    @forelse ($orders as $order)
        <!-- bawah ini adalah component untuk produk -->
        <div id="cardContainer" onclick="window.location.href='{{ route('detailpesanan', $order->receipt_number) }}';"
            class="mx-auto m2ax-w-7xl px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6 md:gap-2 lg:gap-6">
                <div id="kotakProduk"
                    class="m-3 hover:scale-105 transition-transform duration-300 ease-in-out shadow-lg border rounded-lg p-4 sm:px-6 md:px-7 lg:px-8 grid sm:grid-cols-10 md:grid-cols-11 lg:grid-cols-10 gap-2 md:gap-6 lg:gap-6">
                    <!-- Gambar Produk -->
                    <div
                        class="col-start-1 row-start-1 col-span-11  md:col-span-3 md:row-span-4 lg:col-span-3 lg:row-span-4 rounded-lg flex justify-center items-center border overflow-hidden">
                        <img src="{{ $order->product->img_link }}" alt="hasil_tani" id="gbrProduk"
                            class="thumbnail md:w-full md:h-full lg:w-full lg:h-full w-1/2 h-1/2 object-cover md:object-fill">
                        {{-- <img src="{{ $order->product->img_link }}" alt="profile"
                        class="thumbnail md:w-full md:h-full lg:w-full lg:h-full w-1/2 h-1/2 object-contain"> --}}
                    </div>
                    <!-- Nama Produk -->
                    <div id="namaProduk"
                        class="capitalize font-libre-franklin text-base md:text-lg lg:text-xl font-semibold row-start-3 col-span-8 col-start-1 md:col-start-4 md:row-start-1 md:col-span-4 lg:col-start-4 lg:row-start-1 lg:col-span-4 ">
                        {{ $order->product->type->name }}
                    </div>
                    <div
                        class="font-libre-franklin text-xs md:text-sm lg:text-base font-light row-start-2 col-span-8 col-start-1 md:col-start-8 md:row-start-1 md:col-span-4 md:flex md:justify-end ">
                        <h4 id="tglwaktu" class="text-sm">{{ $order->order_time->format('d F Y, H:i') }}</h4>
                    </div>
                    <!-- namapembeli -->
                    <div id="informasi pembeli"
                        class="font-libre-franklin text-sm md:text-base lg:text-lg font-normal row-start-4 col-span-8 col-start-1 md:col-start-4 md:row-start-2 md:col-span-4 lg:col-start-4 lg:row-start-2 lg:col-span-4 ">
                        {{ $order->buyer->email }} <br> {{ $order->buyer->phone_number }}
                    </div>

                    <div
                        class="font-libre-franklin text-lg md:text-lg lg:text-2xl font-semibold row-start-5 col-span-8 col-start-1 md:row-start-2 md:col-start-8 md:col-span-4 md:flex md:justify-end">
                        <h2 id="totharga">Rp {{ number_format($order->historyPrice->price * $order->quantity_kg, 0, ',', '.') }}</h2>
                    </div>
                    <!-- metode pembayaran -->
                    <div id="metode"
                        class="font-libre-franklin text-sm md:text-base lg:text-lg font-normal row-start-6 col-span-5 col-start-1 md:row-start-3 md:col-start-4 md:col-span-4">
                        @if ($order->payment_proof == 'Transfer')
                            <h4 id="tf" class="font-libre-franklin font-normal">Transfer</h4>
                        @else
                            <h4 id="COD" class="font-libre-franklin font-normal">COD</h4>
                        @endif
                        @if ($order->payment_proof == 'Transfer' && $order->order_status == 'selesai')
                            <button id="buktiTF"
                                class="bg-blue-500 rounded-md p-1 flex items-center text-white font-libre-franklin font-light text-sm hover:bg-blue-900 transition ease-in duration-100"
                                onclick="showTFModal(event, '{{ $order->receipt_number }}')">
                                <ion-icon name="document-outline" class="mr-2"></ion-icon>
                                <span class="mt-0.5">Bukti Transfer</span>
                            </button>
                        @endif

                    </div>

                    <div id="kotakStatus"
                        class="font-libre-franklin font-normal row-start-6 col-span-6 col-start-6 md:row-start-3 md:col-start-9 md:col-span-3 md:row-span-2 ">
                        @if ($order->order_status == 'menunggu konfirmasi')
                            <h4 id="bthkonfir" class="bg-yellow-200 text-sm rounded-md p-1 mb-1 flex justify-center relative">
                                Butuh Konfirmasi
                                <span
                                    class="absolute top-1 right-0 transform translate-x-1/2 -translate-y-1/2 flex h-3 w-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                            </h4>
                            <div class="flex justify-center gap-x-4">
                                <button id="batal" class="hover:text-red-500 " onclick="showDecline('{{ $order->receipt_number }}')"><ion-icon
                                        name="close-circle-outline"
                                        class="transition ease-in duration-100 text-3xl"></ion-icon></button>
                                <button id="konfirmasi" class="hover:text-green-500" onclick="showACC({{ $order->id }}, event)"><ion-icon
                                        name="checkmark-circle-outline"
                                        class="transition ease-in duration-100 text-3xl"></ion-icon></button>
                            </div>
                        @elseif ($order->order_status == 'selesai')
                            <h4 id="selesai" class="bg-[#00D120] text-sm rounded-md p-1 mb-1 flex justify-center">Pesanan selesai
                            </h4>
                        @elseif ($order->order_status == 'pesanan diterima')
                            <h4 id="diterima" class="bg-[#4379F2] text-sm rounded-md p-1 mb-1 flex justify-center">Menunggu pembayaran
                            </h4>
                        @elseif ($order->order_status == 'ditolak')
                            <h4 id="ditolak" class="bg-[#f44747] text-sm rounded-md p-1 mb-1 flex justify-center">Pesanan Ditolak
                            </h4>
                        @else
                            <h4 id="dibatal" class="bg-[#FF0000] text-sm rounded-md p-1 mb-1 flex justify-center">Pesanan Dibatalkan
                            </h4>
                        @endif
                    </div>
                </div>
            {{-- modal ketika tekan tombol ceklis (konfirmasi pesanan) --}}
            <x-Modal id="showACC-modal-{{ $order->id }}" class="hidden">
                <div class="grid grid-flow-row">
                    <div class="text-xl font-bold mb-4">Konfirmasi Pesanan</div>
                    <div class="space-y-2">
                        <div class="text-base"><strong>Produk:</strong> {{ $order->product->type->name }} -
                            {{ $order->quantity_kg }} kg</div>
                        <div class="text-base"><strong>Pembeli:</strong> {{ $order->buyer->name }} -
                            {{ $order->buyer->phone_number }}</div>
                        <div class="text-base"><strong>Metode Pembayaran:</strong> {{ $order->payment_proof }}</div>
                        <div class="text-xl font-semibold text-green-600">Total:
                            {{ Number::currency($order->historyPrice->price * $order->quantity_kg, in: 'idr') }}</div>
                    </div>
                    <form id="acceptOrderForm" method="POST" action="{{ route('orders.accept', $order->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" id="tutupModal1"
                                class="border border-black bg-white text-black px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-red-400"
                                onclick="closeModal('showACC-modal-{{ $order->id }}')">
                                TUTUP
                            </button>
                            <button type="submit" id="setuju"
                                class="border border-black bg-green-600 text-white px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-green-400">
                                SETUJU
                            </button>
                        </div>
                    </form>
                </div>
            </x-Modal>
        </div>
    @empty
        <x-Message-info id="info">Belum ada pesanan masuk.</x-Message-info>
    @endforelse

    {{-- modal ketika tekan tombol bukti tf --}}
    <x-Modal id="showTF-modal">
        <div class="grid grid-flow row">
            <div class="text-sm md:text-lg font-libre-franklin font-medium">Bukti Transfer</div>
            <div class="flex justify-center h-20 overflow-y-auto">
                <img id="gambar-transfer" class="h-30 md:h-50" alt="bukti" onclick="window.open(this.src, '_blank');">
            </div>
            <div class="text-xs md:text-base font-libre-franklin font-bold">
                <p class="text-sm md:text-base">Mohon cek rekening anda sebelum melakukan konfirmasi pesanan.</p>
                <p class="text-sm md:text-base">Laporkan jika terjadi penipuan. <a href=""
                        class="hover:underline hover:text-red-500 text-sm md:text-base">Disini</a></p>
            </div>
            <div class="mt-4 flex justify-end space-x-2">
                <button id="tutupmodal2" class="bg-red-600 text-white px-4 py-1 rounded-lg hover:bg-gray-400"
                    onclick="closeModal('showTF-modal')">
                    TUTUP
                </button>
            </div>
        </div>
    </x-modal>


    {{-- modal ketika tekan tombol silang (tolak pesanan) --}}
    <x-Modal id="showDecline-modal">
        <!-- Form alasan penolakan -->
        <form id="decline-product" method="POST" class="grid grid-flow-row">
            @csrf
            @method('POST')
            <div class="text-xl flex justify-center font-bold">Konfirmasi Pesanan</div>
            {{-- input alasan --}}
            <div class="mt-4">
                <label id="label" for="rejection_reason" class="font-base block text-base font-semibold">Alasan Pembatalan</label>
                <textarea id="rejection_reason" name="rejection_reason" rows="4" required
                    class="p-2 block w-full mt-1 border border-black resize-none rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>
            <div id="yakin" class="text-sm font-medium">Pastikan anda yakin membatalkan pesanan!</div>
            {{-- tombol aksi --}}
            <div class="mt-4 flex justify-end space-x-2">
                <!-- Tombol Batal -->
                <button type="button" id="tutupmodal3"
                    class="bg-red-600 text-white px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-red-400"
                    onclick="closeModal('showDecline-modal')">
                    TIDAK
                </button>
                <!-- Tombol Setuju -->
                <button type="submit" id="yatrima"
                    class="bg-blue-600 text-white px-2 py-1 md:px-4 md:py-1 rounded-lg hover:bg-blue-400">
                    YA
                </button>
            </div>
        </form>
    </x-modal>

    <script>
        const body = document.body;

        function showTFModal(event, receipt_number) {
            event.stopPropagation();
            const modal = document.getElementById('showTF-modal');
            const transfer = document.getElementById('gambar-transfer');
            if (modal) {
                modal.classList.remove('hidden');
                body.style.overflow = 'hidden';
                transfer.src = '{{ route('order.bukti-transfer', ':receipt_number') }}'.replace(':receipt_number', receipt_number);
            }
        }
        // fungsi untuk munculin modal silang
        function showDecline(id) {
            event.stopPropagation();
            const modal = document.getElementById('showDecline-modal');
            const formDecline = document.getElementById('decline-product');
            if (modal) {
                modal.classList.remove('hidden');
                body.style.overflow = 'hidden';
                formDecline.action = '{{ route('orders.reject', ':id') }}'.replace(':id', id);
            }
        }

        function showACC(orderId, event) {
            event.stopPropagation();
            const modal = document.getElementById(`showACC-modal-${orderId}`);
            if (modal) {
                modal.classList.remove('hidden');
                body.style.overflow = 'hidden';
            }
        }
        // fungsi close semua modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                body.style.overflow = '';
            }
        }

        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                body.style.overflow = '';
            }
        }
    </script>
</x-layout>
