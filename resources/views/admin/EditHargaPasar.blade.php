<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <title>Pesanan-Bertani.com</title>
</head>
<body>
     -->
<x-layout>
    <x-slot:title>Admin-Edit Harga Pasar-Bertani.com</x-slot:title>

    <p class="text-black text-3xl font-bold py-8">Edit Harga Pasar</p>

    <form class="max-w-md">

    <label for="jenis_produk" class="block mb-2 text-xl font-medium text-black">Jenis Produk</label>
        <select id="jenis_produk" class="block w-full p-2 mb-6 text-sm text-black border border-gray-300 rounded-lg bg-white focus:border-green-600">
            <option selected>Pilih Jenis Produk</option>
            <option value="buah">Buah</option>
            <option value="sayuran">Sayuran</option>
            <option value="biji-bijian">Biji-bijian</option>
        </select>

    <label for="nama_produk" class="block mb-2 text-xl font-medium text-black">Nama Produk</label>
        <select id="nama_produk" class="block w-full p-2 mb-6 text-sm text-black border border-gray-300 rounded-lg bg-white focus:border-green-600">
            <option selected>Pilih Nama Produk</option>
            <option value="buah">Jagung</option>
            <option value="sayuran">Beras</option>
        </select>

    <!-- <div class="relative max-w-sm">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
        </svg>
    </div>
    <input id="datepicker-actions" datepicker datepicker-buttons datepicker-autoselect-today type="text" class="text-black bg-gray-50 border border-gray-300text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal">
    </div> -->

    <div class="mb-6">
    <label for="tanggal" class="block mb-2 text-xl font-medium text-black">Tanggal</label>
        <input type="date" placeholder="Tanggal" name="tanggal"
        class="px-4 py-3 bg-white text-black w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
    </div>

    <div class="mb-6">
    <label for="harga_terendah" class="block mb-2 text-xl font-medium text-black">Harga</label>
        <input type="text" placeholder="Harga Terendah" name="harga_terendah"
        class="px-4 py-3 bg-white text-black w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
    </div>

    <button type="submit"
        class="mb-8 px-5 py-3 w-auto bg-green-500 text-white font-bold text-sm rounded-lg tracking-wide">TAMBAHKAN
    </button>
            
    </form>

</x-layout>
<!-- 
</body>
</html> -->