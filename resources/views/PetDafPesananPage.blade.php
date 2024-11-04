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
        {{-- <div class="card flex flex-col lg:flex-row mx-10 md:mx20 lg:mx-52 rounded lg">
            <img src="./img/logo3.jpg" alt="" height="200" width="300" class="thumbnail">
            <div class="card-details">
                <div class="top flex flex-row justify-between mx-4">
                    <div class="nama">"Nama Produk"</div>
                    <div class="tanggal">"dd-mm-yyyy - 13.20 WIB"</div>
                </div>
                <div class="middle flex flex-row justify-between">
                    <div class="pembeliNotelp">"nama_pembeli - notelpon"</div>
                    <div class="harga">"Rp xx.xxx"</div>


                </div>
                <div class="bottom flex justify-between mx-2">
                    <div class="metpem">"metode_pembayaran"</div>
                    <div class="status">
                        "order_status"

                    </div>
                </div>
                <div class="bottom2 flex justify-between mx-2">
                    <div class="bukt">
                        <button class=" bg-blue-500 rounded-md p-1 items-center text-white"><ion-icon
                                name="document-outline"></ion-icon>
                            <span>Bukti Pembayaran</span>
                        </button>
                    </div>
                    <div class="buttongrup">
                        <button class="text-base rounded-md"><ion-icon name="create-outline"
                                class="transition ease-in duration-300"></ion-icon></span></button>
                        <button class="text-base rounded-md w-10 h-10"onclick="toggleComponent()">
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>

                </div>
            </div>
        </div> --}}
        <div
            class="border rounded-lg p-4 grid sm:grid-cols-2 sm:grid-flow-row md:grid-cols-8 md:grid-flow-row lg:grid-cols-8 lg:grid-flow-row gap-4 items-start">
            <!-- Gambar Produk -->
            <div
                class="sm:col-span-1 sm:row-span-2 md:col-span-3 md:row-span-5 lg:col-span-2 lg:row-span-5 flex justify-center items-center border rounded-lg h-32 md:h-40">
                gambar
            </div>
            <!-- Nama Produk -->
            <div class="sm:col-span-1 md:col-span-3 lg:col-span-4 sm:text-sm md:text-base lg:text-lg font-semibold">
                {{-- {{ $product->name }} --}} "Nama Produk"
            </div>
            <!-- namapembeli -->
            <div
                class="sm:col-span-1 md:row-start-3 md:col-start-4 md:col-span-3 lg:row-start-3 lg:col-start-3 lg:col-span-4 sm:text-sm md:text-base lg:text-lg text-gray-600">
                {{-- {{ $product->product_type }} --}}"nama_pembeli - notelpon"
            </div>
            <div
                class="sm:col-span-1 md:col-start-7 md:col-span-2 lg:row-start-1 lg:col-start-7 lg:col-span-3 sm:text-sm md:text-base lg:text-lg md:flex md:flex-col md:items-end  text-gray-600">
                {{-- {{ $product->price }} --}}
                <h4 class="text-sm">"dd-mm-yyyy - 13.20 WIB"</h4>
            </div>
            <div
                class="sm:col-span-1 md:row-start-3 md:col-start-7 md:col-span-3 lg:row-start-3 lg:col-start-7 lg:col-span-2 sm:text-lg md:text-xl lg:text-2xl md:flex md:flex-col md:items-end text-gray-600">
                <h2>{{-- {{ $product->price }} --}}"Rp xx.xxx"</h2>
            </div>
            <!-- tanggal-jam -->

            <!-- metode pembayaran -->
            <div
                class="sm:col-span-1 md:row-start-5 md:col-start-4 md:col-span-3 lg:row-start-5 lg:col-start-3 lg:col-span-4 sm:text-sm md:text-base lg:text-lg text-gray-600">
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
                class="sm:col-span-2 md:row-start-5 md:col-start-7 md:col-span-2 lg:col-start-7 lg:col-span-2 lg:row-start-5 space-x-2 sm:text-sm md:text-base lg:text-base lg:justify-end md:flex md:flex-col md:items-end md:space-y-2 md:ml-auto lg:flex lg:flex-col lg:items-end lg:space-y-2 lg:ml-auto">
                
                    {{-- if(status butuh konfirmasi) --}}
                    <h4 class="bg-yellow-200 rounded-md p-1 inline-block">"butuh konfirmasi"</h4>
                    {{-- if(status pesanan diproses) --}}
                    {{-- <h4 class="bg-[#6687FF]">"pesanan diproses"</h4> --}}
                    {{-- if(status ppesanan selesai) --}}
                    {{-- <h4 class="bg-[#00D115]">"pesanan selesai"</h4> --}}
                    {{-- if(status mengajukan pembatalan) --}}
                    {{-- <h4 class="bg-[#f44747]">"mengajukan pembatalan"</h4> --}}
                    {{-- if(status pesanan dibatalkan) --}}
                    {{-- <h4 class="bg-[#FF0000]">"mengajukan pembatalan"</h4> --}}
                
                
                    <div class="space-x-2 ml-auto">
                        <button><ion-icon name="close-circle-outline" class="text-3xl"></ion-icon></button>
                        <button><ion-icon name="checkmark-circle-outline" class="text-3xl"></ion-icon></button>
                        {{-- <button><ion-icon name="close-outline" class="color-blue transition ease-in duration-300 rounded-lg border-red-500"></ion-icon></button> --}}
                        {{-- <button onclick="toggleComponent()"><ion-icon name="checkmark-outline" class="transition ease-in duration-300"></ion-icon></button> --}}
                    </div>
            </div>
        </div>

        <div class="grid grid-cols-4 grid-rows-3 gap-4 border rounded-lg p-4">
            <div class="flex col-start-1 col-span-1 row-span-3 border rounded-lg">
                <img src="./img/logo3.jpg" height="200" width="300" alt="">
            </div>
            <div class="col-span-1">{{-- {{ $product->name --}}"Nama Produk"</div>
            <div class="col-end-4">{{-- {{ $product->date --}}"dd-mm-yyyy - 13.20 WIB"</div>
            <div class="col-span-1">{{-- {{ $product->buyer_id --}}"nama_pembeli - notelpon" </div>
            <div class="col-end-4 ">{{-- {{ $product->price --}}"Rp xx.xxx"</div>
            <div class="col-span-1">{{-- {{ $product->payment_proof --}}
                <h4>"metode_pembayaran"</h4>
                {{-- if (metode pembayaran == transfer) : --}}
                <button class=" bg-blue-500 rounded-md p-1 items-center text-white"><ion-icon
                        name="document-outline"></ion-icon>
                    <span>Bukti Pembayaran</span>
                </button>
            </div>
            <div class="col-end-4 ">{{-- {{ $product->price --}}
                <h4>"order_status"</h4>
                <button class="text-base rounded-md"><ion-icon name="create-outline"
                        class="transition ease-in duration-300"></ion-icon></span></button>
                <button class="text-base rounded-md w-10 h-10"onclick="toggleComponent()">
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
