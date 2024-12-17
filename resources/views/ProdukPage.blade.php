<x-layout>
    <x-slot:title>Search Produk-Bertani.com</x-slot:title>

    <!-- Form pencarian -->
    <form action="{{ route('search') }}" method="GET"
        class="flex rounded-md my-8 overflow-hidden max-w-full font-[sans-serif] w-1/2 mx-auto">
        <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari Produk"
            class="w-full outline-none bg-green-600 text-white placeholder-gray-200 text-sm px-4 py-3" />
        <button type="submit" class="flex items-center justify-center bg-green-600 px-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-white">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
        </button>
    </form>



    <!-- Hasil pencarian -->
    <div id="cardContainer" class="mx-auto max-w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 grid-flow-row gap-4">
        @if (isset($products) && $products->count() > 0)
            @foreach ($products as $product)
                <a href="{{ route('product.show', $product->id) }}">
                    <div
                        class="shadow-lg border overflow-hidden rounded-lg grid-flow-row cursor-pointer transition ease-in-out hover:scale-105">
                        <img src="{{ $product->img_link }}" alt="Gambar Produk"
                            class="rounded-t-lg lg:w-72 lg:h-44 md:w-60 md:h-36 sm:w-32 sm:h-20 object-cover mb-1">
                        <div class="p-2 grid-cols-2">
                            <div class="col-span-2 text-base font-mono">
                                {{ ucwords($product->type->name) }}
                            </div>
                            <div class="text-xl font-mono font-bold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <div class="text-sm font-mono font-light capitalize flex">
                                <img src="/img/chinese-farmer-svgrepo-com.png" alt="iconpetani" class="w-5 h-5 mr-2"> <span>{{ Str::before($product->farmer->name, ' ') }}</span>
                            </div>
                            {{-- <div class="text-sm font-mono font-light">
                                {{ $product->description ?: 'Deskripsi tidak tersedia' }}
                            </div> --}}
                            <div class="text-sm font-mono font-light">
                                Terjual : {{ WeightConverter::convert($product->orders->sum('quantity_kg')) }}
                            </div>
                            <div class="text-sm font-mono font-light">
                                Stok : {{ WeightConverter::convert($product->stock_kg) }}
                            </div>

                        </div>
                        {{-- $product->price, 0, ',', '.') }}</p> --}}
                    </div>
            @endforeach
        @elseif(request('query'))
            <div class="col-span-4">
                <x-Message-info>Produk tidak ditemukan. Silahkan cari kembali.</x-Message-info>
            </div>
            {{-- <p class="text-center"></p> --}}
        @else
            <!-- Pesan saat halaman pertama kali dibuka -->
            <div class="col-span-4">
                <x-Message-info>Silahkan cari produk yang Anda inginkan.</x-Message-info>
            </div>
        @endif
    </div>

    <div style="display: none;" id="loading" class="fixed inset-0 flex justify-center items-center w-full h-[100vh]">
        <div class="relative flex justify-center items-center">
            <div class="absolute animate-spin rounded-full h-32 w-32 border-t-4 border-b-4 border-green-600"></div>
            {{-- <img src="https://www.svgrepo.com/show/509001/avatar-thinking-9.svg" class="rounded-full h-28 w-28"> --}}
            <img src="/img/logokecil.png" class="rounded-full h-28 w-28">
        </div>
    </div>

    <button id="scrollToTopBtn"
        class="fixed bottom-8 right-8 bg-green-500 text-white px-3 pt-3 pb-2 rounded-full shadow-lg place-content-center hover:bg-indigo-600 transition duration-300 hidden"
        onclick="scrollToTop()">
        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg> --}}
        <ion-icon name="arrow-up-circle-outline" class="h-6 w-6"></ion-icon>
    </button>

    @isset($query)
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            let page = 1;
            let isLoading = false; // Tambahkan flag untuk mencegah panggilan berulang

            $(window).scroll(function() {
                // Cek jika halaman sudah mencapai bagian bawah
                if (!isLoading && $(window).scrollTop() + $(window).height() >= $(document).height() - 15) {
                        $('#loading').show(); // Tampilkan elemen loading
                        loadMoreData(++page); // Panggil halaman berikutnya
                }
            });


            function loadMoreData(page) {
                isLoading = true; // Set flag untuk mencegah pemanggilan berulang
                $.ajax({
                    url: '/search/load?query={{ $query }}&page=' + page,
                    type: "get",
                    beforeSend: function() {
                        $('#loading').show(); // Tampilkan elemen loading sebelum data dimuat
                    }
                }).done(function(data) {
                    if (data === "") {
                        $('#loading').hide();
                        isLoading = false; // Izinkan pemanggilan ulang jika diperlukan
                        return;
                    }
                    $('#loading').hide(); // Sembunyikan elemen loading setelah data berhasil dimuat
                    $("#cardContainer").append(data); // Tambahkan data baru ke kontainer
                    isLoading = false; // Reset flag
                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    $('#loading').hide();
                    page--;
                    isLoading = false; // Reset flag
                });
            }
        </script>
        <script>
            const scrollToTopBtn = document.getElementById("scrollToTopBtn");

            // Tampilkan tombol saat pengguna scroll ke bawah
            window.addEventListener("scroll", () => {
                if (window.scrollY > 300) {
                    scrollToTopBtn.classList.remove("hidden");
                } else {
                    scrollToTopBtn.classList.add("hidden");
                }
            });

            // Fungsi untuk scroll ke atas
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
            }
        </script>
    @endisset

</x-layout>
