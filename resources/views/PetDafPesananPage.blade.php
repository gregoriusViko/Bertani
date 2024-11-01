<x-layout>
    <x-slot:title>Daftar Pesanan-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Daftar Pesanan</h1>
        </div>
    </div>

    <!-- bawah ini adalah component untuk produk -->
    <div id="cardContainer"
        class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
        {{-- @foreach ($products as $product) --}}
        <div class="grid grid-cols-5 grid-rows-4 gap-4 border rounded-lg p-4">
            <div class="col-start-1 col-span-2 row-span-4 border rounded-lg">gambar </div>
            <div class="col-span-2">{{-- {{ $product->name --}}"Nama Produk"</div>
            <div class="col-end-6">{{-- {{ $product->date --}}"dd-mm-yyyy - 13.20 WIB"</div>
            <div class="col-span-2">{{-- {{ $product->buyer_id --}}"nama_pembeli - notelpon" </div>
            <div class="col-end-6 ">{{-- {{ $product->price --}}"Rp xx.xxx"</div>
            <div class="col-span-2">{{-- {{ $product->payment_proof --}}
                <h4>"metode_pembayaran"</h4>
                {{-- if (metode pembayaran == transfer) : --}}
                <button class="bg-blue-500 rounded-md p-1 items-center text-white"><ion-icon
                    name="document-outline"></ion-icon>
                <span>Bukti Pembayaran</span>
            </button>
            </div>
            <div class="col-end-6 ">{{-- {{ $product->price --}}
                <h4>"order_status"</h4> 
                <button class="text-base rounded-md"><ion-icon name="create-outline"
                        class="transition ease-in duration-300"></ion-icon></span></button>
                <button class="text-base rounded-md"onclick="toggleComponent()">
                    <ion-icon name="checkmark-circle-outline"></ion-icon>
                </button>
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
    </div>
</x-layout>
