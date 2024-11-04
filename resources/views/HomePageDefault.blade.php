<x-layout>
    <x-slot:title>Home-Bertani.com</x-slot:title>
    <div class="jumbotron mt-6 bg-cover bg-center flex flex-col items-center justify-center text-gray-800 gap-x-3 p-10 rounded-lg mx-auto max-w-4xl px-5 sm:px-5 md:px-5 lg:px-0"
        style="background-image: url('./img/bgjumbo.jpg');">
        <h1 class="font-hind font-semibold text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white text-center">
            BELI PRODUK HASIL TANI
        </h1>
        <p class="font-hind font-normal mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-white text-center">
            Dukung petani lokal dan rasakan hasil bumi Indonesia.
        </p>
    </div>

    {{-- <div class="relative w-full h-52 min-w-[16rem] max-w-5xl mx-auto sm:mx-4 md:mx-6 lg:mx-8 overflow-hidden rounded-xl">
        <!-- Carousel Wrapper -->
        <div class="overflow-hidden relative h-50">
            <!-- Slides -->
            <div id="carouselSlides" class="flex rounded-lg transition-transform duration-500">
                <div class="w-full flex-shrink-0">
                    <img src="./img/carousel1.jpg" class="w-full h-56 object-cover" alt="Slide 1">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="./img/carousel2.jpg" class="w-full h-56 object-cover" alt="Slide 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="img/carousel3.jpeg" class="w-full h-56 object-cover" alt="Slide 3">
                </div>
            </div>
        </div>
        <!-- Indicator Dots -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <span class="dot w-3 h-3 bg-green-600 rounded-full cursor-pointer" onclick="goToSlide(0)"></span>
            <span class="dot w-3 h-3 bg-green-600 rounded-full cursor-pointer" onclick="goToSlide(1)"></span>
            <span class="dot w-3 h-3 bg-green-600 rounded-full cursor-pointer" onclick="goToSlide(2)"></span>
        </div>
    </div>
    <script src="./js/carousel.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const header = document.querySelector("header");
                const main = document.querySelector("main");
                const headerHeight = header.offsetHeight;

                main.style.paddingTop = `${headerHeight}px`;
            });
        </script> --}}

    {{-- form searching --}}
    <form class="mt-4 px-5 mb-4 max-w-md mx-auto" action="">
        <label for="searching" class="mb-2  font-hind font-normal text-sm font-regular text-white sr-only">Cari
            Produk</label>
        <div class="relative items-center">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 py-2 pointer-events-none text-white">
                <ion-icon name="search" class="text-white text-lg"></ion-icon>
            </div>
            <input type="search" id="default-search"
                class="block w-full py-2 pl-10 pr-20 text-sm font-hind item-center font-normal text-white border border-gray-300 rounded-lg bg-green-600 placeholder-white"
                placeholder="Cari Produk" required />
            <button type="submit"
                class="flex item-center text-white font-hind font-normal absolute right-2 top-1/2 -translate-y-1/2  bg-green-600 hover:bg-white hover:text-green-600 focus:ring-2 focus:ring-white rounded-lg text-sm px-4 py-2 m-0 ">
                Search
            </button>
        </div>
    </form>
    {{-- card produk --}}
    <div id="cardContainer"
        class="mx-auto max-w-4xl px-8 sm:px-8 md:px-5 lg:px-0 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 grid-flow-row gap-10">
        {{-- @foreach ($products as $product) --}}

        <div class="shadow-lg border overflow-hidden rounded-lg grid-flow-row cursor-pointer" onclick="handleClick()">
            <img class="rounded-t-lg lg:w-72 lg:h-44 md:w-60 md:h-36 sm:w-32 sm:h-20 object-cover mb-1"
                src="./img/logo3.jpg" alt="">
            <div class="p-2 grid-cols-2">
                <div class="col-span-2 text-base font-hind font-normal">
                    "Nama Produk" - "Berat"
                </div>
                <div class="text-xl font-hind font-bold">
                    "Rp XX.XXX"
                </div>
                <div class="text-sm font-hind font-light">
                    "Nama petani" - "asal"
                </div>
                <div class="text-sm font-hind font-light">
                    "Terjual : xx "
                </div>
                <div class="text-sm font-hind font-light">
                    "Stok : xx kg"
                </div>

            </div>
        </div>



        <script>
            function handleClick() {
                // Lakukan aksi di sini, misalnya:
                window.location.href = "link-ke-halaman"; // Mengalihkan ke halaman lain
            }
        </script>

    </div>


</x-layout>
