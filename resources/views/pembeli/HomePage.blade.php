<x-layout-pembeli>
    <x-slot:title>Home-Bertani.com</x-slot:title>
    <div class="jumbotron mt-6 bg-cover bg-centerflex items-center justify-center text-gray-800 gap-x-3 p-14 w-15 rounded-lg font-[sans-serif] max-w-4xl mx-auto" style="background-image: url('./img/bgjumbo.jpg');">
        <h1 class="text-4xl font-extrabold text-white text-center">BELI PRODUK HASIL TANI</h1>
        <p class="mt-4 text-base text-white text-center">Dukung petani lokal dan rasakan hasil bumi Indonesia.</p>
  
        {{-- <button type="button"
          class="px-6 py-3 mt-8 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-blue-600 hover:bg-blue-700">Learn
          more</button> --}}
    </div>
    
    {{-- form searching --}}
    <form class="mt-4 px-5 max-w-md mx-auto" action="">
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
</x-layout-pembeli>