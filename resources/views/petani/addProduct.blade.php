<x-layout>
    <x-slot:title>Tambah Produk-Bertani.com</x-slot:title>
    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Tambah Produk</h1>
    </div>
    <div class="mt-4 px-7 mx-auto max-w-screen-lg" x-data="{ imageUrl: '/img/noimage.png' }">
        <form enctype="multipart/form-data" method="POST" action="{{route('products.Toko')}}" class="grid grid-cols-1 md:grid-cols-2 gap-4 mx-auto max-w-full">
            @csrf

            <div>
                <img :src="imageUrl" class="rounded-md border-2 w-[400px] h-[300px] object-contain" />
            </div>
            <div>
                <div>
                    <x-input-label for="foto" :value="__('Foto')" />
                    <x-text-input accept="image/*" id="foto" class="block mt-1 w-full border p-2" type="file"
                        name="foto" :value="old('foto')" required
                        @change="imageUrl = URL.createObjectURL($event.target.files[0])" />
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>

                <!-- Jenis Produk Dropdown -->
                <!-- <div class="mt-4 relative">
                    <x-input-label for="jenis" :value="__('Jenis Produk')" />
                    <button type="button" id="jenisProdukButton" onclick="toggleDropdown('jenisDropdown')"
                        class="px-4 py-2 w-full shadow-lg border bg-white text-gray-400 text-sm font-inter font-normal border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 justify-start">
                        <div class="flex items-end w-full justify-between">
                            <p id="selectedJenis">Pilih Jenis Produk</p>
                            <div class="block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500 inline ml-3"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                        clip-rule="evenodd" data-original="#000000" />
                                </svg>
                            </div>
                        </div>
                    </button> -->

                    <!-- Dropdown menu untuk kategori -->
                    <!-- <ul id="jenisDropdown"
                        class="absolute hidden shadow-[0_8px_19px_-7px_rgba(6,81,237,0.2)] bg-white py-2 z-[99] w-full max-w-[full] divide-y max-h-96 overflow-auto rounded-lg mt-1">
                        @foreach ($categories as $category)
                            <li onclick="selectJenis('{{ $category->category }}')"
                                class="py-3 px-5 hover:bg-green-400 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                                {{ $category->category }}
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" id="jenis" name="jenis" />

                    <x-input-error :messages="$errors->get('jenis')" class="mt-2 " />
                </div> -->

                <!-- Nama Produk Dropdown -->
                <!-- <div class="mt-4 relative">
                    <x-input-label for="nama" :value="__('Nama Produk')" />
                    <button type="button" id="namaProdukButton" onclick="toggleDropdown('namaDropdown')"
                        class="px-4 py-2 w-full shadow-lg border bg-white text-gray-400 text-sm font-inter font-normal border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 justify-start">
                        <div class="flex items-end w-full justify-between">
                            <p id="selectedNamaProduk">Pilih Nama Produk</p>
                            <div class="block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500 inline ml-3"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                        clip-rule="evenodd" data-original="#000000" />
                                </svg>
                            </div>
                        </div>
                    </button> -->

                    <!-- Dropdown menu untuk nama produk -->
                    <!-- <ul id="namaDropdown"
                        class="absolute hidden shadow-[0_8px_19px_-7px_rgba(6,81,237,0.2)] bg-white py-2 z-[99] w-full max-w-[full] divide-y max-h-96 overflow-auto rounded-lg mt-1"> -->
                        <!-- Nama produk akan diisi secara dinamis melalui JavaScript -->
                    <!-- </ul>
                    <input type="hidden" id="nama" name="nama" />

                    <x-input-error :messages="$errors->get('nama')" class="mt-2 " />
                </div> -->
                
            <!-- Jenis Produk Dropdown -->
             <div class="mt-4 relative">
                <x-input-label for="jenis" :value="__('Jenis Produk')" />
                <select id="categoryDropdown" name="jenis" class="block mt-1 w-full border-gray-300 focus:border-green-600 rounded-lg" required>
                    <option disabled selected>Pilih Jenis Produk</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div> 

            <!-- Nama Produk Dropdown -->
             <div class="mt-4 relative">
                <x-input-label for="namaProduk" :value="__('Nama Produk')" />
                <select id="productDropdown" name="nama" class="block mt-1 w-full border-gray-300 focus:border-green-600 rounded-lg" required>
                    <option disabled selected>Pilih Nama Produk</option>
                    <!-- Nama produk akan diisi secara dinamis melalui JavaScript -->
                 </select>
            </div>


                <div class="mt-4">
                    <x-input-label for="Stok" :value="__('Jumlah Stok')" />
                    <x-text-input id="Stok" class="block mt-1  border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 w-full" type="number" name="stok"
                        :value="old('Stok')" x-mask:dynamic="$Stok($input, ',')" required />
                    <x-input-error :messages="$errors->get('Stok')" class="mt-2 " />
                </div>

                <div class="mt-4">
                    <x-input-label for="harga" :value="__('Harga')" />
                    <x-text-input id="harga" class="block mt-1 w-full border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50" type="text" name="harga"
                        :value="old('harga')" required />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                    <x-text-area id="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50" type="text"
                        name="deskripsi">{{ old('deskripsi') }}</x-text-area>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>
                <div class="mt-4 flex space-x-2 justify-end">
                    <button class="items-end text-white bg-red-600 px-4 py-1 rounded-lg hover:bg-red-400 mr-2" type="button" id="cancel-button">BATAL</button>
                    <button class="item-end text-white bg-green-600 px-4 py-1 rounded-lg hover:bg-green-400" type="submit" id="add-button" >TAMBAH</button>
                </div>
                {{-- <x-primary-button class="justify-center w-full mt-4">
                    {{ __('Submit') }}
                </x-primary-button> --}}
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