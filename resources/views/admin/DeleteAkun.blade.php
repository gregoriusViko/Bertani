<x-layout>
    <x-slot:title>Admin-Delete Akun User-Bertani.com</x-slot:title>
    <div class="rounded-lg mt-8 px-7 mx-auto max-w-screen-lg">
        <form class="mb-4 max-lg:max-w-xl max-lg:mx-auto flex justify-center mt-4 gap-3">
            <label for="cariAkun" class="text-xs md:text-base lg:text-lg text-black px-4 font-semibold">Cari Akun</label>
            <input type="text" id="cariAkun"
                class="pl-3 border border-black rounded-md w-1/2 block font-libre-franklin font-medium text-xs md:text-base lg:text-lg text-black">
            <button class="text-xs md:text-base lg:text-lg rounded-md bg-blue-500 text-white hover:bg-blue-700 px-3 ">OK</button>
        </form>

        <div class="rounded-md mt-8 px-7 mx-auto max-w-screen-lg bg-blue-400 py-4">
            <div class=" grid grid-flow-row gap-4  items-center place-items-center ">
                <div class="items-center place-items-center">
                    <div class="avatar mb-3 w-20 h-20  ">
                        <img class="rounded-full object-cover w-20 h-20" src="/img/orang.jpeg.jpg" alt="avatar">

                    </div>
                    <h2 class="text-xs md:text-base font-libre-franklin font-bold text-black">nama pengguna</h2>
                    <h4 class="font-libre-franklin font-normal text-sm text-gray-700">role</h4>
                </div>
                <div class="w-full md:w-1/2">
                    <label for="nama-input"
                        class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">Nama
                        Pengguna</label>
                    <input type="text" id="nama-input" name="name"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="" required readonly />
                </div>
                <div class="w-full md:w-1/2">
                    <label for="alamat-input"
                        class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">Alamat</label>
                    <input type="text" id="alamat-input" name="home_address"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="" required readonly />
                </div>
                <div class="w-full md:w-1/2">
                    <label for="notelp-input"
                        class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">No
                        Telepon</label>
                    <input type="tel" id="notelp-input" name="phone_number"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="" required readonly />
                </div>
                <div id="button" class="my-3 flex place-items-end ">
                    <div class="flex items-end space-x-2 justify-between">
                        <button onclick="showPopup('teruskan')"
                            class="rounded-md text-xs md:text-base bg-gray-400 hover:bg-gray-600 text-white px-2 py-1">BATALKAN</button>
                        <button onclick="showPopup('teruskan')"
                            class="rounded-md text-xs md:text-base bg-gray-400 text-white hover:bg-red-600 px-2 py-1">HAPUS
                            AKUN</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
