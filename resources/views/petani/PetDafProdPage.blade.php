<x-layout>
    <x-slot:title>Daftar Produk-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Daftar Produk</h1>

            <div dir="rtl">
                <a href="{{route('products.create')}}">
                <button
                    class="font-libre-franklin font-light flex items-center justify-center text-white bg-green-300 px-4 py-1 rounded-lg hover:bg-green-600"
                    type="button" id="addProduct-button">
                    <span><ion-icon name="add-circle-outline" class="ml-2 mt-1.5 text-lg"></ion-icon></span>
                    Tambah Produk
                </button>
                </a>
            </div>
        </div>
    </div>

    <!-- bawah ini adalah component untuk produk -->
    <div id="cardContainer"
        class="mx-auto max-w-7xl px-4 py-1 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-6">
        @foreach ($products as $product)
            <div class="shadow-lg border rounded-lg p-4 grid sm:grid-cols-2 sm:grid-flow-row md:grid-cols-8 md:grid-flow-row lg:grid-cols-8 lg:grid-flow-row gap-4 items-start">
                <!-- Gambar Produk -->
                <div class="sm:col-span-1 sm:row-span-2 md:col-span-3 md:row-span-5 lg:col-span-2 lg:row-span-5 flex justify-center items-center border rounded-lg sm:w-24 sm:h-24 lg:w-60 lg:h-48 md:w-56 md:h-44 md:mt-1 overflow-hidden">
                    <img src="./img/logo3.jpg" alt="profile" class="thumbnail md:w-full md:h-full lg:w-full lg:h-full sm:w-1/2 sm:h-1/2 object-cover">
                </div>
                <!-- Nama Produk -->
                <div class="font-libre-franklin font-semibold sm:col-span-1 md:col-span-3 lg:col-span-4 sm:text-sm md:text-base lg:text-lg lg:ml-5 md:-ml-5">
                    {{ $product->name }}
                </div>
                <!-- Jenis Produk -->
                <div class="font-libre-franklin font-medium sm:col-span-1 md:row-start-3 md:col-start-4 md:col-span-3 lg:row-start-3 lg:col-start-3 md:-ml-5  lg:ml-5 lg:col-span-4 sm:text-sm md:text-base lg:text-lg text-gray-600">
                    Jenis Produk: {{ $product->product_type }}
                </div>
                <!-- Harga Produk -->
                <div class="font-libre-franklin font-medium sm:col-span-1 md:col-start-7 md:col-span-2 lg:row-start-1 lg:col-start-7 lg:col-span-2 sm:text-base md:text-lg lg:text-2xl md:flex md:justify-end  text-gray-600">
                    {{ Number::currency($product->price, in: 'idr') }}
                </div>
                <!-- Jumlah Stok -->
                <div class="font-libre-franklin font-medium sm:col-span-1 md:row-start-5 md:col-start-4 md:col-span-3 lg:row-start-5 lg:col-start-3 md:-ml-5 lg:ml-5 lg:col-span-4 sm:text-sm md:text-base lg:text-lg text-gray-600">
                    Jumlah Stok: {{ WeightConverter::convert($product->stock_kg) }}
                </div>
                <!-- Tombol Aksi -->
                <div class="sm:col-span-2 md:row-start-5 md:col-start-7 md:col-span-2 lg:col-start-7 lg:col-span-2 lg:row-start-5 md:flex md:justify-end space-x-2 sm:text-sm md:text-base lg:text-lg  ">
                    <!--Tombol Edit-->
                    <a href="{{ route('product.edit', $product->id) }}" class="rounded-md hover:text-blue-500">
                        <ion-icon name="create-outline" class="transition ease-in duration-100 text-2xl"></ion-icon>
                    </a>
                    <!-- Tombol Hapus -->
                    <button onclick="toggleComponent()" class="rounded-md hover:text-red-500">
                        <ion-icon name="trash-outline" class="transition ease-in duration-100 text-xl"></ion-icon>
                    </button>
                </div>
            </div>
        @endforeach
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

</x-layout>
