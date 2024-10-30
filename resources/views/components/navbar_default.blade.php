<div>
    <nav class="flex justify-between items-center w-[90%]  mx-auto">
        <div>
            <img class="w-23 h-20" src = "img/logo1.png" alt="Your Company">
        </div>
        <div
            class="nav-links duration-500 md:static absolute bg-green-600 md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5 py-4">
            <ul class="relative font-[hind] flex md:flex-row flex-col md:items-center md:gap-[2vw] gap-8">
                <li>
                    <!-- <a class="rounded-md bg-gray-900 px-3 py-2 font-semibold text-white text-base"
                        href="#">Beranda</a> -->
                    <a class="rounded-md px-3 py-2 font-semibold text-white text-base"
                        href="{{ route('/') }}" class="{{ request()->routeIs('/') ? $activeColor : 'bg-green-600' }}">Beranda</a>
                </li>
                <li>
                    <!-- <a class="rounded-md px-3 py-2 font-semibold text-gray-300 text-base hover:bg-gray-700 hover:text-white"
                        href="#">Harga Pasar</a> -->
                    <a class="rounded-md px-3 py-2 font-semibold text-white text-base"
                        href="{{ route('pesanan') }}" class="{{ request()->routeIs('pesanan') ? $activeColor : 'bg-green-600' }}">Harga Pasar</a>
                </li>
                <li>
                    <!-- <a class="rounded-md px-3 py-2 font-semibold text-gray-300 text-base hover:bg-gray-700 hover:text-white"
                        href="#">Produk</a> -->
                    <a class="rounded-md px-3 py-2 font-semibold text-white text-base"
                        href="{{ route('hargapasar') }}" class="{{ request()->routeIs('hargapasar') ? $activeColor : 'bg-green-600' }}">Produk</a>
                </li>
                <li>
                    <!-- <a class="rounded-md px-3 py-2 font-semibold text-gray-300 text-base hover:bg-gray-700 hover:text-white"
                        href="#">Pesanan</a> -->
                    <a class="rounded-md px-3 py-2 font-semibold text-white text-base"
                        href="{{ route('pesanan') }}" class="{{ request()->routeIs('pesanan') ? $activeColor : 'bg-green-600' }}">Pesanan</a>
                </li>
                <li>
                    <div x-data="{ isOpen: false }" class="relative inline-block text-left">
                        <div>
                            <button type="button" @click="isOpen = !isOpen" 
                                class="{{ route('chat' or 'report') }}" class="{{ request()->routeIs('chat' or 'report') ? $homeColor : 'bg-green-600' }}inline-flex w-full justify-center gap-x-1.5 rounded-md bg-green-600 px-3 py-2 text-base font-semibold text-gray-300 hover:bg-gray-700 hover:text-white"
                                id="menu-button" aria-expanded="true" aria-haspopup="true">
                                Lainnya
                                <svg class="-mr-1 h-5 w-5 text-gray-300 hover:text-white" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute left-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="#"
                                    class="block px-4 py-2 relative font-[hind] text-1xl text-black hover:bg-green-600 cursor-pointer"
                                    role="menuitem" tabindex="-1" id="menu-item-0">Chat</a>
                                <a href="#"
                                    class="block px-4 py-2 relative font-[hind] text-1xl text-black hover:bg-green-600 cursor-pointer"
                                    role="menuitem" tabindex="-1" id="menu-item-1">Laporan</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-6">
            <button
                class="bg-green-600 text-white px-4 py-1 rounded-full hover:bg-white hover:text-green-600 flex items-center justify-center space-x-2"
                type="button">
                <span class="group-hover:text-green-600 relative font-[hind]"><a href="">Login</a></span>
                <ion-icon name="person-circle-outline" class="text-2xl group-hover:text-green-600"></ion-icon>
            </button>
            <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
        </div>
    </nav>
</div>

<script>
    function toggleDropdownMenu() {
        const dropdown = document.getElementById("lainnyaDropdownMenu");
        dropdown.classList.toggle("hidden");
    }
</script>
