<x-layout>
    <x-slot:title>Detail Product '#idproduk'-Bertani.com</x-slot:title>

    <div class="px-7 mx-auto max-w-screen-lg mt-8 grid lg:grid-rows-16 lg:grid-flow-col gap-4">
        <div class=" row-span-8 flex justify-center items-center border border-red-400">
            {{-- gambar --}}
        </div>
        <div class="row-span-4 col-span-2 flex justify-start items-center border border-red-400">
            <div class="text-start">
                <h1 class="font-inter font-normal text-3xl mb-1">"Nama Produk"</h1>
                <div class="flex items-center">
                    <ion-icon name="person-circle-outline" class="text-nd"></ion-icon>
                    <h4 class="font-inter text-md font-normal ml-1 hover:underline">"Nama Petani"</h4>
                </div>
                <div class="flex items-center">
                    <ion-icon name="location-outline" class="text"></ion-icon>
                    <h4 class="font-inter text-md font-normal ml-1 hover:underline">"Alamat lengkap petani"
                    </h4>
                </div>
                <div class="mt-2">
                    <h1 class="font-inter font-bold text-3xl">"Rp XX.XXX"</h1>
                </div>

            </div>
        </div>
        <div class="row-span-4 col-span-2  flex items-center border border-red-400">
            <div class="text-start w-full">
                <div class="border border-black rounded-md w-full">
                    <h1 class="font-inter font-normal text-lg">Deskripsi</h1>
                    <x-text-area id="deskripsi" class="block mt-1 w-full rounded-lg border border-black" type="text"
                        name="deskripsi">testing ini kalimat deskripsi Lorem ipsum dolor, sit amet consectetur adipisicin elit. Cum ex, vel quisharum illo non mollitia dicta placeat consectetur officia molestias consequatur assumenda a ut fugit totam modi corporis alias.</x-text-area>
                </div>
                <div class="mt-4">
                    <h1 class="font-inter font-normal text-lg">Pesan Sekarang</h1>
                </div>
                <div class="border border-black rounded-md w-full">
                    <div class="border  rounded-md grid grid-flow-col ">
                        <div class="w 1/2">
                            <div class="font-inter font-normal text-lg">
                                <h3 class="ml-2">Jumlah Stok</h3>
                                <div class="mt-2 grid grid-cols-2">
                                    <input type="number" class=" w-3/4 ml-2 border border-black rounded-md">
                                        <h3 class="text-sm font-inter">Sisa stok : xx </h3>
                                </div>
                                <div class="mt-2 grid grid-cols-2">
                                    <h3 class="ml-2">Subtotal</h3>
                                    <h3 class="font-inter font-bold text-xl">Rp xxx.xxx</h3>
                                </div>
                            </div>
                        </div>
                        <div class="w 1/2">
                            <div class="font-inter font-normal text-lg">
                                <h3 class="font-bold">Pembayaran</h3>
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
                                
                                {{-- <div class="mt-2 grid grid-cols-2">
                                    <h3 class="ml-2">Subtotal</h3>
                                    <h3 class="font-inter font-bold text-xl">Rp xxx.xxx</h3>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

    </div>

</x-layout>
