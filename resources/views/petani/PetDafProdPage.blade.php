<x-layout>
    <x-slot:title>Daftar Produk-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div
            class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-2 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-base md:text-3xl font-bold tracking-tight text-gray-900">Daftar Produk</h1>

            <div dir="rtl">
                <a href="{{ route('products.create') }}">
                    <button
                        class="font-libre-franklin font-light flex items-center justify-center text-white bg-green-600 px-4 py-1 rounded-lg hover:bg-green-300"
                        type="button" id="addProduct-button">
                        <span class="text-base md:text-lg"><ion-icon name="add-circle-outline"
                                class="ml-2 mt-1.5 text-base md:text-lg"></ion-icon></span>
                        Tambah Produk
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- bawah ini adalah component untuk produk -->
    <div id="cardContainer"
        class="mx-auto max-w-7xl px-3 py-1 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-6 pb-4">
        @foreach ($products as $product)
            <div
                class="shadow-lg border rounded-lg p-4 grid sm:grid-cols-2 sm:grid-flow-row md:grid-cols-8 md:grid-flow-row lg:grid-cols-8 lg:grid-flow-row gap-4 items-start">
                <!-- Gambar Produk -->
                <div
                    class="row-start-1 sm:col-span-1 sm:row-span-2 md:col-span-3 md:row-span-4 lg:col-span-2 lg:row-span-4 flex justify-center items-center border rounded-lg sm:w-24 sm:h-24 lg:w-60 lg:h-48 md:w-56 md:h-44 md:mt-1 overflow-hidden">
                    <img src="{{ $product->img_link }}" alt="hasil_tani"
                        class="thumbnail md:w-full md:h-full lg:w-full lg:h-full w-1/2 h-1/2 object-cover">
                </div>
                <!-- Nama Produk -->
                <div
                    class="capitalize font-libre-franklin font-semibold sm:col-span-1 md:col-span-3 lg:col-span-4 sm:text-sm md:text-lg lg:text-xl lg:ml-10">
                    {{ $product->type->name }}
                </div>
                <!-- Jenis Produk -->
                <div
                    class="font-libre-franklin font-medium sm:col-span-1 md:row-start-2 md:col-start-4 md:col-span-3 lg:row-start-2 lg:col-start-3 lg:ml-10 lg:col-span-4 sm:text-sm md:text-base lg:text-lg text-gray-600">
                    Jenis Produk: {{ $product->type->category }}
                </div>
                {{-- Tanggal update terbaru --}}
                <div
                    class="font-libre-franklin font-medium row-start-2 sm:col-span-1 md:col-start-7 md:row-start-1 md:col-span-2 lg:row-start-1 lg:col-start-7 lg:col-span-2 text-xs md:text-base lg:text-base text-gray-600 md:flex md:justify-end">
                    {{ $product->updated_at }}
                </div>
                <!-- Harga Produk -->
                <div
                    class="font-libre-franklin font-medium row-start-4 sm:col-span-1 md:col-start-7 md:row-start-2 md:col-span-2 lg:row-start-2 lg:col-start-7 lg:col-span-2 sm:text-base md:text-lg lg:text-2xl md:flex md:justify-end  text-gray-600">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                    {{-- {{ Number::currency($product->price, in: 'idr') }} --}}
                </div>
                <!-- Jumlah Stok -->
                <div
                    class="font-libre-franklin font-medium sm:col-span-1 md:row-start-3 md:col-start-4 md:col-span-3 lg:row-start-3 lg:col-start-3 lg:ml-10 lg:col-span-4 sm:text-sm md:text-base lg:text-lg text-gray-600">
                    Sisa Stok: {{ WeightConverter::convert($product->stock_kg) }}
                </div>
                <!-- Jumlah Terjual -->
                <div
                    class="font-libre-franklin font-medium sm:col-span-1 md:row-start-4 md:col-start-4 md:col-span-3 lg:row-start-4 lg:col-start-3 lg:ml-10 lg:col-span-4 sm:text-sm md:text-base lg:text-lg text-gray-600">
                    Jumlah Terjual: {{ WeightConverter::convert($product->orders->where('order_status', 'selesai')->sum('quantity_kg')) }}
                </div>

                <!-- Tombol Aksi -->
                <div
                    class="sm:col-span-2 md:row-start-4 md:col-start-7 md:col-span-2 lg:col-start-7 lg:col-span-2 lg:row-start-4 md:flex md:justify-end space-x-2 sm:text-sm md:text-base lg:text-lg  ">
                    <!--Tombol Edit-->
                    <a href="{{ route('product.edit', $product->slug) }}" id="editProduk" class="rounded-md hover:text-blue-500">
                        <ion-icon name="create-outline" class="transition ease-in duration-100 text-2xl"></ion-icon>
                    </a>
                    <!--Tombol hapus-->
                    <button id="buttonHapusProduk" onclick="toggleComponent('{{ $product->id }}')"
                        class="rounded-md  hover:text-red-500"><ion-icon name="trash-outline"
                            class="transition ease-in duration-100 text-xl"></ion-icon>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Form Konfirmasi Hapus -->
    @foreach ($products as $product)
        <div id="deleteConfirm-{{ $product->id }}"
            class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 w-screen h-screen">
            <div class="bg-white p-6 rounded-lg shadow-xl w-96">
                <form action="{{ route('product.destroy') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('DELETE')
                    <p class="text-gray-700 font-medium text-center">Apakah Anda yakin ingin menghapus produk ini?</p>
                    <div class="flex justify-center space-x-4">
                        <input type="hidden" name="product" value="{{ $product->id }}">
                        <button type="submit" id="yesHapus"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200">Hapus</button>
                        <button type="button" onclick="toggleComponent('{{ $product->id }}')"
                            id="noCancel" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md transition duration-200">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- message ketika sukses untuk menambah dan atau mengupdate produk --}}
    @if (session('SuksesTambah'))
        <div id="successMessage"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
            <x-Message-success message="{{ session('Sukses') }}">
                Produk Baru Berhasil Ditambahkan
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif

    {{-- message ketika sukses untuk menambah dan atau mengupdate produk --}}
    @if (session('SuksesUpdate'))
        <div id="successMessage"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
            <x-Message-success message="{{ session('SuksesUpdate') }}">
                Data Produk Berhasil Diperbaharui
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif

    {{-- message ketika sukses untuk menghapus produk --}}
    @if (session('SuksesHapus'))
        <div id="successMessage"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
            <x-Message-success message="{{ session('SuksesHapus') }}">
                Produk telah dihapus dengan sukses.
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif

    {{-- message ketika gagal menghapus produk --}}
    @if (session('GagalHapus'))
        <div id="errorMessage"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
            <x-Message-error message="{{ session('error') }}">
                Terjadi kesalahan saat menghapus produk.
                <button onclick="closeMessage('error')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-error>
        </div>
    @endif


    <script>
        const body = document.body;
        function toggleComponent(productId) {
            const modal = document.getElementById(`deleteConfirm-${productId}`);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden'); // Tampilkan modal
                body.style.overflow = 'hidden'; // Kunci scroll/
            } else {
                modal.classList.add('hidden'); // Sembunyikan modal
                body.style.overflow = ''; // Aktifkan scroll
            }
        }
        // Function to close the message component
        function closeMessage(elementId) {
            const messageElement = document.getElementById(elementId);
            if (messageElement) {
                messageElement.style.display = 'none';
                body.style.overflow = ''; // Aktifkan scroll
            }
        }

        // Hilangkan pesan secara otomatis setelah 5 detik
        window.onload = function() {
            const messageElement = document.getElementById('successMessage');
            if (messageElement) {
                // document.body.style.overflow = 'hidden';
                body.style.overflow = 'hidden'; // Kunci scroll
                setTimeout(() => {
                    closeMessage('successMessage');
                }, 3000); // 5000 ms = 5 detik
            }

            // Hilangkan pesan error setelah 5 detik
            const errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                body.style.overflow = 'hidden';
                setTimeout(() => {
                    closeMessage('errorMessage');
                }, 3000); // 5000 ms = 5 detik
            }
        };
    </script>

</x-layout>
