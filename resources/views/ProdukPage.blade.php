<!-- <x-layout>
    <x-slot:title>Produk-Bertani.com</x-slot:title>

    <div class="flex rounded-md my-8 overflow-hidden max-w-full font-[sans-serif] w-1/2 mx-auto">
        <input type="text" id="searchInput" placeholder="Cari Produk"
            class="w-full outline-none bg-green-600 text-white placeholder-gray-200 text-sm px-4 py-3" />
        <button type='button' onclick="searchProducts()" class="flex items-center justify-center bg-green-600 px-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-white">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
        </button>
    </div>

    <div id="results" class="mt-8 w-1/2 mx-auto">

    </div>

    <script>
    function searchProducts() {
        const query = document.getElementById('searchInput').value;

        fetch(`/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.getElementById('results');
                resultsContainer.innerHTML = '';

                if (data.length === 0) {
                    resultsContainer.innerHTML = '<p class="text-center">Produk tidak ditemukan.</p>';
                    return;
                }

                data.forEach(product => {
                    resultsContainer.innerHTML += `
                        <div class="p-4 border rounded-md shadow-md mb-4">
                            <img src="${product.img_link}" alt="Gambar Produk" class="w-full h-32 object-cover mb-2">
                            <h2 class="font-bold text-lg">${product.slug}</h2>
                            <p>${product.description}</p>
                            <p>Stok: ${product.stock_kg} kg</p>
                            <p>Harga: Rp ${product.price}</p>
                        </div>
                    `;
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

</x-layout> -->

<x-layout>
    <x-slot:title>Produk-Bertani.com</x-slot:title>

    <!-- Form pencarian -->
    <form action="{{ route('search') }}" method="GET" class="flex rounded-md my-8 overflow-hidden max-w-full font-[sans-serif] w-1/2 mx-auto">
        <input 
            type="text" 
            name="query" 
            value="{{ request('query') }}" 
            placeholder="Cari Produk"
            class="w-full outline-none bg-green-600 text-white placeholder-gray-200 text-sm px-4 py-3"
        />
        <button type="submit" class="flex items-center justify-center bg-green-600 px-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-white">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
        </button>
    </form>

    <!-- Hasil pencarian -->
    <div id="results" class="mt-8 w-1/2 mx-auto">
        @if(isset($products) && $products->count() > 0)
            @foreach($products as $product)
                <div class="p-4 border rounded-md shadow-md mb-4">
                    <img src="{{ $product->img_link }}" alt="Gambar Produk" class="w-full h-32 object-cover mb-2">
                    <h2 class="font-bold text-lg">{{ $product->type->name }}</h2>
                    <p>{{ $product->description ?: 'Deskripsi tidak tersedia' }}</p>
                    <p>Stok: {{ $product->stock_kg }} kg</p>
                    <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            @endforeach
        @else
            <p class="text-center">Produk tidak ditemukan.</p>
        @endif
    </div>
</x-layout>

