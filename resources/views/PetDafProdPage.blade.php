<x-layout>
    <x-slot:title>Daftar Produk-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Daftar Produk</h1>

            <div dir="rtl">
                <button
                    class="items-center justify-center text-white bg-green-300 px-4 py-1 rounded-lg hover:bg-green-600"
                    type="button" id="addProduct-button" onclick="toggleAllInputs()">
                    <span><ion-icon name="add-circle-outline" class="ml-2 text"></ion-icon></span>
                    Tambah Produk
                </button>
            </div>
        </div>
    </div>

    <!-- bawah ini adalah component untuk produk -->
    <div id="cardContainer"
        class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
        {{-- @foreach ($products as $product) --}}
        <div class="grid grid-cols-5 grid-rows-4 gap-4 border rounded-lg p-4">
            <div class="col-start-1 col-span-2 row-span-4 border rounded-lg">gambar </div>
            <div class="col-span-2">{{-- {{ $product->name --}}"Nama Produk"</div>
            <div class="col-end-6 ">{{-- {{ $product->price --}}"Rp xx.xxx"</div>
            <div class="col-span-2">{{-- {{ $product->product_type --}}Jenis Produk : </div>
            <div class="col-span-2">{{-- {{ $product->stock --}}Jumlah Stok :</div>
            <div class="col-end-6 ">
                <button><ion-icon name="create-outline"
                        class="transition ease-in duration-300"></ion-icon></span></button>
                <button onclick="toggleComponent()"><ion-icon name="trash-outline" class="transition ease-in duration-300"></ion-icon></button>
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
