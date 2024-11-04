<x-layout>
    <x-slot:title>Daftar Pesanan-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mb-4 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Daftar Pesanan</h1>
        </div>
    </div>

    <!-- bawah ini adalah component untuk produk -->
    <div id="cardContainer"
        class="mx-auto max-w-7xl px-4 py-1 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6 mt-1">
        {{-- @foreach ($products as $product) --}}
        <div
            class="border rounded-lg p-4 grid sm:grid-cols-2 sm:grid-flow-row md:grid-cols-8 md:grid-flow-row lg:grid-cols-8 lg:grid-flow-row gap-4 items-start">
            <!-- Gambar Produk -->
            <div
                class="sm:col-span-1 sm:row-span-2 md:col-span-3 md:row-span-5 lg:col-span-2 lg:row-span-5 flex justify-center items-center border rounded-lg sm:w-1/2 sm:h-1/2 lg:w-60 lg:h-48 md:w-56 md:h-44 md:mt-1 overflow-hidden">
                <img src="./img/logo3.jpg" alt="profile" class="thumbnail md:w-full md:h-full lg:w-full lg:h-full sm:w-1/2 sm:h-1/2 object-cover">
            </div>
            <!-- Nama Produk -->
            <div
                class="sm:col-span-1 md:col-span-3 lg:col-span-4 sm:text-sm md:text-base lg:text-lg font-semibold mt-1 lg:ml-5 md:-ml-5">
                {{-- {{ $product->productname }} --}} "Nama Produk"
            </div>
            <!-- namapembeli -->
            <div
                class="sm:col-span-1 md:row-start-3 md:col-start-4 md:col-span-3 lg:row-start-3 lg:col-start-3 lg:col-span-4 lg:ml-5 md:-ml-5 sm:text-sm md:text-base lg:text-lg text-gray-600">
                {{-- {{ $product->buyername - no telp }} --}}"nama_pembeli - notelpon"
            </div>
            <div
                class="sm:col-span-1 md:col-start-7 md:col-span-3 lg:row-start-1 lg:col-start-7 lg:col-span-3 sm:text-sm md:text-base lg:text-lg md:flex md:flex-col md:items-end  text-gray-600 mt-1">
                {{-- {{ $product->date }} --}}
                <h4 class="text-sm">"dd-mm-yyyy - 13.20 WIB"</h4>
            </div>
            <div
                class="sm:col-span-1 md:row-start-3 md:col-start-7 md:col-span-3 lg:row-start-3 lg:col-start-7 lg:col-span-3 sm:text-lg md:text-xl lg:text-2xl md:flex md:flex-col md:items-end text-gray-600">
                <h2>{{-- {{ $product->price }} --}}"Rp xx.xxx"</h2>
            </div>


            <!-- metode pembayaran -->
            <div
                class="sm:col-span-1 md:row-start-5 md:col-start-4 md:col-span-3 lg:row-start-5 lg:col-start-3 lg:col-span-4 lg:ml-5 md:-ml-5 sm:text-sm md:text-base lg:text-lg text-gray-600">
                {{-- {{ $product->stock }} --}}
                <h4>"metode_pembayaran"</h4>
                {{-- if (metode pembayaran == transfer) : --}}
                <button class=" bg-blue-500 rounded-md p-1 items-center text-white text-sm hover:bg-blue-900 "><ion-icon
                        name="document-outline"></ion-icon>
                    <span>Bukti Pembayaran</span>
                </button>
            </div>
            <!-- Tombol Aksi -->
            <div
                class="sm:col-span-2 md:row-start-5 md:col-start-7 md:col-span-3 lg:col-start-7 lg:col-span-3 lg:row-start-5 space-x-2 sm:text-sm md:text lg:text lg:justify-end md:flex md:flex-col md:items-end md:ml-auto lg:flex lg:flex-col lg:items-end  lg:ml-auto">

                {{-- if(status butuh konfirmasi) --}}
                <h4 class="bg-yellow-200 rounded-md p-1 inline-block mb-1">"butuh konfirmasi"</h4>
                {{-- if(status pesanan diproses) --}}
                {{-- <h4 class="bg-[#6687FF]">"pesanan diproses"</h4> --}}
                {{-- if(status ppesanan selesai) --}}
                {{-- <h4 class="bg-[#00D115]">"pesanan selesai"</h4> --}}
                {{-- if(status mengajukan pembatalan) --}}
                {{-- <h4 class="bg-[#f44747]">"mengajukan pembatalan"</h4> --}}
                {{-- if(status pesanan dibatalkan) --}}
                {{-- <h4 class="bg-[#FF0000]">"mengajukan pembatalan"</h4> --}}


                <div class="space-x-2 ml-auto mb-0">
                    <button><ion-icon name="close-circle-outline" class="text-3xl"></ion-icon></button>
                    <button><ion-icon name="checkmark-circle-outline" class="text-3xl"></ion-icon></button>
                    {{-- <button><ion-icon name="close-outline" class="color-blue transition ease-in duration-300 rounded-lg border-red-500"></ion-icon></button> --}}
                    {{-- <button onclick="toggleComponent()"><ion-icon name="checkmark-outline" class="transition ease-in duration-300"></ion-icon></button> --}}
                </div>
            </div>
        </div>
    </div>
    <div id="componentContainer" class="hidden mt-4">
        @include('components.delete_confirm')
    </div>
    <script>
        function toggleComponent() {
            const container = document.getElementById('componentContainer');
            container.classList.toggle('hidden');
        }
    </script>
    {{-- @endforeach --}}

</x-layout>
