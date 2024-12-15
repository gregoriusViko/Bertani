<x-layout>
    <x-slot:title>Harga Pasar Terbaru-Bertani.com</x-slot:title>

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-black py-6 text-center">Harga Pasar Terbaru</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        @php
            $currentCategory = null;
        @endphp

        <div class="space-y-8 mb-7">
            @forelse ($categories as $category)
                @if ($category->category !== $currentCategory)
                    @if (!is_null($currentCategory))
        </div> <!-- Close the previous category's items container -->
    </div> <!-- Close the previous category's card -->
    @endif

    <!-- New category card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <h2 class="text-2xl font-semibold text-black bg-gray-100 px-6 py-4">
            {{ ucfirst($category->category) }}
        </h2>
        <div class="divide-y divide-gray-200">
            @php
                $currentCategory = $category->category;
            @endphp
            @endif

            <!-- Category item -->
            <div class="flex items-center justify-between px-6 py-4">
                <div>
                    <div class="text-gray-800 font-medium">{{ ucfirst($category->name) }}</div>
                    <div class="text-sm text-gray-500">Terakhir diperbarui: {{ \Carbon\Carbon::parse($category->updated_at)->format('d M Y, H:i') }}</div>
                </div>
                <div class="text-gray-600 font-medium">Rp {{ number_format($category->market_price, 0, ',', '.') }}</div>
            </div>
        @empty
            <p class="text-center text-gray-600">Tidak ada data harga pasar.</p>
            @endforelse

            <!-- Close the last category -->
            @if (!is_null($currentCategory))
        </div> <!-- Close the last category's items container -->
    </div> <!-- Close the last category's card -->
    @endif
    <div>
        <button id="scrollToTopBtn"
            class="fixed bottom-8 right-8 bg-green-500 text-white px-3 pt-3 pb-2 rounded-full shadow-lg place-content-center hover:bg-indigo-600 transition duration-300 hidden"
            onclick="scrollToTop()">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg> --}}
            <ion-icon name="arrow-up-circle-outline" class="h-6 w-6"></ion-icon>
        </button>
    </div>

    <script>
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        // Tampilkan tombol saat pengguna scroll ke bawah
        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) {
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
</x-layout>
