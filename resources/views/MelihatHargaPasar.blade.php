<x-layout>
    <x-slot:title>Harga Pasar - Bertani.com</x-slot:title>

    <p class="text-black text-3xl font-bold py-8">Harga Pasar</p>

    @foreach ($categories as $category)
        <!-- Nama Kategori -->
        <p class="text-black text-2xl font-bold py-4">{{ $category->category }}</p>
        
        <!-- Produk berdasarkan Kategori -->
        @foreach ($category->product as $product)
            <p class="text-black text-xl font-semibold py-4">{{ $product->name }}</p>
            <div class="relative overflow-x-auto border border-black mb-12">
                <table class="w-full text-sm rtl:text-right text-black text-center">
                    <thead class="text-xs text-black uppercase bg-gray-300 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3">No.</th>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3">Harga Pasar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ number_format($product->market_price, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    @endforeach

    <div class="h-12"></div>
</x-layout>
