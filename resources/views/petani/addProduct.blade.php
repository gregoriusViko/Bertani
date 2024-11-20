<x-layout>
    <x-slot:title>Tambah Produk-Bertani.com</x-slot:title>
    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Tambah Produk</h1>
    </div>
    <div class="mt-4 px-7 mx-auto max-w-screen-lg" x-data="{ imageUrl: '/img/noimage.png' }">
        <form enctype="multipart/form-data" method="POST" action="{{route('products.Toko')}}" class="grid grid-cols-1 md:grid-cols-2 md:gap-7 mx-auto max-w-full">
            @csrf
            {{-- kiri gambar --}}
            <div>
                <img :src="imageUrl" class="rounded-md border-2 md:w-full w-[400px] h-[300px] object-contain shadow-md" />
                <div class="mt-4">
                    <x-input-label for="foto" :value="__('Foto')" />
                    <x-text-input accept="image/*" id="foto" class="block mt-1 w-full border p-2" type="file"
                        name="foto" :value="old('foto')" required
                        @change="imageUrl = URL.createObjectURL($event.target.files[0])" />
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>
            </div>
            {{-- kanan --}}
            <div>
                <!-- Jenis Produk Dropdown -->
                <div class="relative">
                    <x-input-label for="jenis" :value="__('Jenis Produk')" />
                    <select id="categoryDropdown" name="jenis" class="block mt-1 w-full pl-3 pr-3 py-2  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md" required>
                        <option disabled selected class="hover:bg-green-600">Pilih Jenis Produk</option>
                        @foreach ($categories as $category)
                            <option class="bg-white hover:bg-green-600" value="{{ $category->category }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div> 

                <!-- Nama Produk Dropdown -->
                <div class="mt-4 relative">
                    <x-input-label for="namaProduk" :value="__('Nama Produk')" />
                    <select id="productDropdown" name="nama" class="block mt-1 w-full pl-3 py-2  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md" required>
                        <option disabled selected>Pilih Nama Produk</option>
                        <!-- Nama produk akan diisi secara dinamis melalui JavaScript -->
                    </select>
                </div>
                {{-- jumlah stok --}}
                <div class="mt-4 ">
                    <x-input-label for="Stok" :value="__('Jumlah Stok')" />
                    <x-text-input id="Stok"
                        class="block mt-1  border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 w-full"
                        type="number" name="stok" :value="old('Stok')" x-mask:dynamic="$Stok($input, ',')" required />
                    <x-input-error :messages="$errors->get('Stok')" class="mt-2 " />
                </div>
                {{-- harga --}}
                <div class="mt-4">
                    <x-input-label for="harga" :value="__('Harga')" />
                    <x-text-input id="harga"
                        class="block mt-1 w-full border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50"
                        type="text" name="harga" :value="old('harga')" required />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>
                {{-- deskripsi --}}
                <div class="mt-4">
                    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                    <x-text-area id="deskripsi"
                        class="block mt-1 w-full border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50"
                        type="text" name="deskripsi">{{ old('deskripsi') }}</x-text-area>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>
                {{-- button --}}
                <div class="mt-4 flex space-x-2 justify-end">
                    <button class="items-end text-white bg-red-600 px-4 py-1 rounded-lg hover:bg-red-400 mr-2"
                        type="button" id="cancel-button">BATAL</button>
                    <button class="item-end text-white bg-green-600 px-4 py-1 rounded-lg hover:bg-green-400"
                        type="submit" id="add-button">TAMBAH</button>
                </div>
            </div>

        </form>
    </div>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById(id);
            dropdownMenu.classList.toggle("hidden");
        }

        document.getElementById("categoryDropdown").addEventListener("change", function() {
            const selectedCategory = this.value;

            // Mengambil data produk berdasarkan kategori melalui AJAX
            fetch(`/products/get-by-category/${selectedCategory}`)
                .then(response => response.json())
                .then(data => {
                    const productDropdown = document.getElementById("productDropdown");
                    productDropdown.innerHTML = '<option disabled selected>Pilih Nama Produk</option>';

                    // Tambahkan produk ke dropdown nama produk
                    for (const [id, name] of Object.entries(data)) {
                        const option = document.createElement("option");
                        option.value = id;
                        option.textContent = name;
                        productDropdown.appendChild(option);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

</x-layout>
