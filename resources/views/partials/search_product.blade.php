@if($products->isEmpty())
    <div class="text-center text-gray-500 font-mono">
        <p>Tidak ada produk yang ditemukan untuk pencarian ini.</p>
    </div>
@else
    @foreach ($products as $product)
        <a href="/products/{{ $product->slug }}">
            <div class="shadow-lg border overflow-hidden rounded-lg grid-flow-row cursor-pointer" onclick="handleClick()">
                <img class="rounded-t-lg lg:w-72 lg:h-44 md:w-60 md:h-36 sm:w-32 sm:h-20 object-cover mb-1" 
                     src="{{ $product->img_link ?? 'noimage.png' }}" alt="{{ $product->name }}">
                <div class="p-2 grid-cols-2">
                    <!-- Nama Produk -->
                    <div class="text-lg font-mono font-bold">
                        {{ $product->name }}
                    </div>
                    <!-- Harga -->
                    <div class="text-xl font-mono font-bold text-green-600">
                        {{ Number::currency($product->price, in: 'idr') }}
                    </div>
                    <!-- Kategori Produk -->
                    <div class="text-sm font-mono font-light">
                        Jenis: {{ $product->type->name }}
                    </div>
                    <!-- Asal Petani -->
                    <div class="text-sm font-mono font-light">
                        Petani: {{ Str::before($product->farmer->name, ' ') }} 
                    </div>
                    <!-- Stok -->
                    <div class="text-sm font-mono font-light">
                        Stok: {{ WeightConverter::convert($product->stock_kg) }}
                    </div>
                </div>
            </div>
        </a>
    @endforeach
@endif
