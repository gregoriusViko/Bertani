<x-layout>
    <x-slot:title>Home-Bertani.com</x-slot:title>

    <div class="text-sm font-medium text-center">
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
                <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">LAPORAN</a>
            </li>
            <li class="me-2">
                <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">DAFTAR LAPORAN</a>
            </li>
        </ul>
    </div>

    <div class="border border-black p-8 rounded-md w-full h-auto">
        <p class="text-3xl font-bold mb-4">Laporan Sistem</p>
        
        <div class="mb-4">
            <label for="message" class="block text-xl font-normal mb-4">Deskripsi Laporan</label>
            <textarea id="message" rows="3" placeholder="" class="w-full h-60 p-2 mt-1 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
        </div>

        <p class="text-2xl font-bold mb-4">Foto Bukti Laporan</p>

        <div class="mb-4">
            <input type="file" id="uploadImage" accept="image/*" class="mt-1 block w-full text-sm text-gray-500
            file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-700 
            file:text-white hover:file:bg-blue-500 active:scale-95">
        </div>

        <p class="block text-base font-normal mb-4">Saya dengan ini menyatakan bahwa segala informasi yang dilaporkan memang benar</p>
            
        <div class="flex justify-end space-x-4">
            <button class="px-4 py-2 bg-white rounded-lg border border-black">Batal</button>
            <button class="px-4 py-2 bg-white-300 rounded-lg border border-black">Kirim</button>
        </div>
    </div>
</x-layout>