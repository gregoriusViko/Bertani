<x-layout>
    <x-slot:title>Tambah Produk-Bertani.com</x-slot:title>
    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Tambah Produk</h1>
    </div>
    {{-- <div id="cardContainer"
        class="mx-auto max-w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 grid-flow-row gap-4"> --}}

    <div class="mt-4 ">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mx-auto max-w-full">
            {{-- komponen gambar --}}
            <div class="items-center">
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 hover:bg-gray-100 ">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                    </label>
                </div>

            </div>
            {{-- komponen gambar --}}
            <div>
                <form method="POST">
                    @csrf

                    <div class="mt-0">
                        <x-input-label for="nama" :value="__('Nama Produk')" />
                        <x-text-input id="nama" class="block mt-1 w-full  rounded-md " type="text" name="nama"
                            :value="old('nama')" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2 " />
                    </div>
                    <style>
                        #jenis {
                            max-height: 120px;
                            /* Sesuaikan tinggi berdasarkan opsi */
                            overflow-y: auto;
                            /* Aktifkan scrollbar jika melebihi tinggi */
                        }
                    </style>
                    <div class="mt-4 relative">
                        <x-input-label for="jenis" :value="__('Jenis Produk')" />
                        <button type="button" id="peran" onclick="toggleDropdown()"
                            class="px-4 py-2 shadow-lg border bg-white text-gray-400 text-sm font-inter font-normal border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 justify-start w-full max-w-[450px]">
                            <div class="flex items-end w-full justify-between">
                                <p id="selectedOption">jenis</p>
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
                            class="absolute hidden shadow-[0_8px_19px_-7px_rgba(6,81,237,0.2)] bg-white py-2 z-[99] w-full max-w-[450px] divide-y max-h-96 overflow-auto rounded-lg mt-1">
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
                        <x-text-input id="Stok" class="block mt-1 w-9/12  rounded-md " type="number" name="Stok"
                            :value="old('Stok')" x-mask:dynamic="$Stok($input, ',')" required />
                        <x-input-error :messages="$errors->get('Stok')" class="mt-2 " />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('Harga')" />
                        <div class="flex"items-center>
                            <span
                                class="px-3 py-2 bg-gray-200 border  border-gray-300 rounded-l-md text-gray-700">
                                Rp
                            </span>
                            <x-text-input id="harga" class="block mt-1 w-full rounded-r-md" type="number" name="harga"
                                :value="old('harga')" x-mask:dynamic="$money($input, ',')" x-on:input="formatCurrency"
                                required />
                        </div>

                        <x-input-error :messages="$errors->get('harga')" class="mt-2 " />
                    </div>



                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <x-text-area id="deskripsi" class=" mt-1 w-full h-32" type="text"
                            name="deskripsi">{{ old('deskripsi') }}</x-text-area>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    {{-- <x-primary-button class="justify-center w-full mt-4">
                    {{ __('Submit') }}
                </x-primary-button> --}}


                </form>
            </div>
        </div>
    </div>

    {{-- </div> --}}


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
