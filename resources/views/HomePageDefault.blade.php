<x-layout>
    <x-slot:title>Home-Bertani.com</x-slot:title>
    <div class="jumbotron mt-6 bg-cover bg-centerflex items-center justify-center text-gray-800 gap-x-3 p-10 w-15 rounded-lg font-[sans-serif] mx-auto max-w-4xl px-4 sm:px-6 lg:px-6" style="background-image: url('./img/bgjumbo.jpg');">
        <h1 class="lg:text-4xl md:text-4xl sm:text-lg font-extrabold text-white text-center">BELI PRODUK HASIL TANI</h1>
        <p class="mt-4 text-base text-white text-center">Dukung petani lokal dan rasakan hasil bumi Indonesia.</p>
  
       
    </div>
    
    {{-- form searching --}}
    <form class="mt-4 px-5 mb-4 max-w-md mx-auto" action="">
        <label for="searching" class="mb-2 text-sm font-regular text-white sr-only">Cari Produk</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-white">
                <ion-icon name="search" class="text-white"></ion-icon>
            </div>
            <input type="search" id="default-search"
                class="block w-full p-4 pl-10 text-sm text-white border border-gray-300 rounded-lg bg-green-600 placeholder-white focus:ring-green-500 focus:border-green-500"
                placeholder="Cari Produk" required />
            <button type="submit"
                class="text-white absolute right-2.5 bottom-2.5 bg-green-600 hover:bg-white hover:text-green-600 focus:ring-4 focus:ring-white font-medium rounded-lg text-sm px-4 py-2 ">
                Search
            </button>
        </div>
    </form>
    <div id="cardContainer" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 grid-flow-row gap-10">
        {{-- @foreach ($products as $product) --}}
        @foreach ($products as $product)
        <div class="shadow-lg border overflow-hidden rounded-lg grid-flow-row cursor-pointer" onclick="handleClick()">
            <img class="rounded-t-lg lg:w-72 lg:h-44 md:w-60 md:h-36 sm:w-32 sm:h-20 object-cover mb-1" src="./img/logo3.jpg" alt="">
            <div class="p-2 grid-cols-2">
                <div class="col-span-2 text-base font-mono">
                    {{ $product->name }} - "Berat"
                </div>
                <div class="text-xl font-mono font-bold">
                    Rp {{ Number::format($product->price) }}
                </div>
                <div class="text-sm font-mono font-light">
                    {{ Str::before($product->farmer->name, ' ') }} - "asal"
                </div>
                <div class="text-sm font-mono font-light">
                    "Terjual : xx "
                </div>
                <div class="text-sm font-mono font-light">
                    "Stok : {{ $product->stock }} Kg"
                </div>
                
            </div>
        </div>
        @endforeach
        
        

        <script>
            function handleClick() {
                // Lakukan aksi di sini, misalnya:
                window.location.href = "link-ke-halaman"; // Mengalihkan ke halaman lain
            }
        </script>
       
    </div>


</x-layout>