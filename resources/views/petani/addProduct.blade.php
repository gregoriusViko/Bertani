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

                <div class="mt-4">
                    <x-input-label for="nama" :value="__('Nama')" />
                    <x-text-input id="nama" class="block mt-1 w-full border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50" type="text" name="nama"
                        :value="old('nama')" required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <div class="mt-4 relative">
                    <x-input-label for="jenis" :value="__('Jenis Produk')" />
                    <button type="button" id="peran" onclick="toggleDropdown()"
                        class="px-4 py-2 w-full shadow-lg border bg-white text-gray-400 text-sm font-inter font-normal border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 justify-start">
                        <div class="flex items-end w-full justify-between">
                            <p id="selectedOption">Jenis</p>
                            <!-- Element ini akan diupdate dengan teks opsi terpilih -->
                            <div class="block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500 inline ml-3"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                        clip-rule="evenodd" data-original="#000000" />
                                </svg>
                            </div>
                        </div>
                    </button>

                    <!-- Dropdown menu -->
                    <ul id="dropdownMenu"
                        class="absolute hidden shadow-[0_8px_19px_-7px_rgba(6,81,237,0.2)] bg-white py-2 z-[99] w-full max-w-[full] divide-y max-h-96 overflow-auto rounded-lg mt-1">
                        <li onclick="selectOption('Gabah')"
                            class="py-3 px-5 hover:bg-green-400 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                            Gabah</li>
                        <li onclick="selectOption('Buah')"
                            class="py-3 px-5 hover:bg-green-400 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                            Buah</li>
                        <li onclick="selectOption('Sayuran')"
                            class="py-3 px-5 hover:bg-green-400 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                            Sayuran</li>
                    </ul>

                    <x-input-error :messages="$errors->get('jenis')" class="mt-2 " />
                </div>

                <div class="mt-4">
                    <x-input-label for="Stok" :value="__('Jumlah Stok')" />
                    <x-text-input id="Stok" class="block mt-1  border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 w-full" type="number" name="Stok"
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
                    <button class="item-end text-white bg-green-600 px-4 py-1 rounded-lg hover:bg-green-400" type="submit" id="add-button" disabled>TAMBAH</button>
                </div>
                {{-- <x-primary-button class="justify-center w-full mt-4">
                    {{ __('Submit') }}
                </x-primary-button> --}}
            </div>

        </form>
    </div>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById("dropdownMenu");
            dropdownMenu.classList.toggle("hidden");
        }

        // Fungsi untuk memilih opsi dan menutup dropdown
        function selectOption(option) {
            const selectedOptionElement = document.getElementById("selectedOption");
            selectedOptionElement.innerText = option;
            selectedOptionElement.classList.add("text-gray-800");

            document.getElementById("selectedOption").innerText = option; // Tampilkan teks opsi terpilih di button
            document.getElementById("peranValue").value = option;
            toggleDropdown(); // Tutup dropdown setelah memilih opsi
        }

        // Tutup dropdown jika klik di luar area dropdown atau button
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById("dropdownMenu");
            const button = document.getElementById("peran");

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    </script>

</x-layout>