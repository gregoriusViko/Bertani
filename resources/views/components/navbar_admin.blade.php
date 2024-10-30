<div>
    <nav class="flex justify-between items-center w-[90%]  mx-auto">
        <div>
            <img class="w-23 h-20" src = "img/logo1.png" alt="Your Company">
        </div>
        <div
            class="nav-links duration-500 md:static absolute bg-green-600 md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5 py-4">
            <ul class="relative font-[hind] flex md:flex-row flex-col md:items-center md:gap-[2vw] gap-8">
                <li>
                    <a class="rounded-md bg-gray-900 px-3 py-2 font-semibold text-white text-base"
                        href="#">Laporan</a>
                </li>
                <li>
                    <a class="rounded-md px-3 py-2 font-semibold text-gray-300 text-base hover:bg-gray-700 hover:text-white"
                        href="#">Harga Pasar</a>
                </li>
                <li>
                    <a class="rounded-md px-3 py-2 font-semibold text-gray-300 text-base hover:bg-gray-700 hover:text-white"
                        href="#">Hapus Akun</a>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-6">
            <button
                class="bg-green-600 text-white px-4 py-1 rounded-full hover:bg-white hover:text-green-600 flex items-center justify-center space-x-2"
                type="button">
                <span class="group-hover:text-green-600">#petani</span>
                <ion-icon name="person-circle-outline" class="text-2xl group-hover:text-green-600"></ion-icon>
            </button>
            <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
        </div>
    </nav>
</div>
