<x-layout>
    <x-slot:title>Home-Bertani.com</x-slot:title>
    <div class="jumbotron mt-6 bg-cover bg-center flex flex-col items-center justify-center text-gray-800 gap-x-3 p-10 rounded-lg mx-auto max-w-full px-4 sm:px-5 md:px-5 lg:px-0"
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
    <div class="flex rounded-md my-5 overflow-hidden max-w-full font-[sans-serif]">
        <input type="email" placeholder="Cari Produk"
            class="w-full outline-none bg-green-600 text-white placeholder-gray-200 text-sm px-4 py-3" />
        <button type='button' onclick="" class="flex items-center justify-center bg-green-600 px-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-white">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
        </button>
    </div>

    {{-- card produk --}}
    <div id="cardContainer"
        class="mx-auto max-w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 grid-flow-row gap-4">
        {{-- @foreach ($products as $product) --}}
        @include('partials.product')      
    </div>

    <div id="loading" style="display: none;">Loading...</div>
    <script>
        function handleClick() {
            // Lakukan aksi di sini, misalnya:
            window.location.href = "link-ke-halaman"; // Mengalihkan ke halaman lain
        }
    </script> 

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            let page = 1;
    
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 15) {
                    loadMoreData(++page);
                }
            });
    
            function loadMoreData(page) {
                $.ajax({
                    url: '/products/load?page=' + page,
                    type: "get",
                    beforeSend: function() {
                        $('#loading').show();
                    }
                }).done(function(data) {
                    if (data == "") {
                        $('#loading').html("No more records found");
                        return;
                    }
                    $('#loading').hide();
                    $("#cardContainer").append(data);
                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    $('#loading').html("Sedang ada gangguan");
                });
            }
        </script>


</x-layout>
