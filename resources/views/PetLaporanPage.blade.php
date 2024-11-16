<x-layout>
    <x-slot:title>Home-Bertani.com</x-slot:title>

    <!-- <div class="text-sm font-medium text-center">
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
                <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">LAPORAN</a>
            </li>
            <li class="me-2">
                <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">DAFTAR LAPORAN</a>
            </li>
        </ul>
    </div> -->

    <div class="mt-4">
        <button type="button" class="p-4 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
            data-tab-target="#tab1">Laporan</button>
        <button type="button" class="p-4 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
            data-tab-target="#tab2">Daftar Laporan</button>
    </div>

    <div id="tab1" class="tab-content border border-black rounded-md w-full h-auto">
        <form class="p-8 w-full h-auto">
            <p class="text-2xl font-bold mb-4">Laporan Sistem</p>

            <div class="mb-4">
                <label for="message" class="block text-xl font-normal mb-2">Deskripsi Laporan</label>
                <textarea id="message" rows="3" placeholder=""
                    class="w-full h-48 p-2 mt-1 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>

            <p class="text-xl font-bold mb-2">Foto Bukti Laporan</p>

            <div class="mb-2">
                <input type="file" id="uploadImage" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-700 
                file:text-white hover:file:bg-blue-500 active:scale-95">
            </div>

            <p class="block text-base font-normal mb-2">Saya dengan ini menyatakan bahwa segala informasi yang
                dilaporkan memang benar</p>

            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelButton"
                    class="inline-flex gap-x-2 px-4 py-2 bg-white rounded-lg border border-black  shadow hover:shadow-md transition-shadow hover:bg-orange-300">
                    <img src="/img/laporanbatal.png" alt="icon_batal" class="w-5 h-5">Batal</button>
                <button type="submit"
                    class="inline-flex gap-x-2 px-4 py-2 bg-white-300 rounded-lg border border-black  shadow hover:shadow-md transition-shadow hover:bg-orange-300">
                    <img src="/img/laporanlaporkan.png" alt="icon_laporkan" class="w-5 h-5">Laporkan</button>
            </div>
        </form>
    </div>

    <div>
        <div>
            <div id="tab2" class="tab-content border border-black p-8 w-full h-auto hidden rounded-md">
                <p class="text-2xl font-bold mb-4">Daftar Laporan</p>

                {{-- kotak perlaporan --}}
                <div class="border border-green-600 p-5 w-full h-auto rounded-md">
                    <p class="text-sm mb-2">1 Oktober 2024 - 15.40 WIB || 12345 - Purnomo </p>

                    {{-- <p class="py-4"></p> --}}
                    <p class="text-xl font-medium py-2">Laporan Pesanan</p>
                    <ul class="ml-4 list-disc text-lg font-medium">
                        <li>Berat produk tidak sesuai pesanan</li>
                    </ul>

                    {{-- <p class="py-4"></p> --}}
                    <p class="text-xl font-medium mt-2 py-2">Tanggapan</p>
                    <ul class="ml-4 list-disc text-lg font-medium">
                        <li>Baik, akan kami tindak lanjutin. Terimakasih </li>
                    </ul>

                    <form>
                        {{-- <p class="py-4"></p> --}}
                        <p class="text-xl font-medium mt-5">Balas Tanggapan?</p>
                        <textarea id="replyMessage" rows="3" placeholder=""
                            class="w-4/5 h-10 p-2 mt-1 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                        <button onclick=""><img src="/img/paperplane.png" alt="icon_teruskan"
                                class="w-9 h-9"></button>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll('[data-tab-target]');
        const activeClass = "bg-gray-200";
        const cancelButton = document.getElementById('cancelButton');
        const form = document.querySelector('#tab1 form')

        //tab default
        tabs[0].classList.add(activeClass);
        document.querySelector('#tab1').classList.remove('hidden');

        //eventlistener tiap tab
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetContent = document.querySelector(tab.dataset.tabTarget);
                //console.log(targetContent)

                //menambah hidden class untuk menambah tab-content div
                document.querySelectorAll('.tab-content').forEach(content => content.classList.add(
                    'hidden'));

                //menghapus class aktif ie bg-indigo-200 dari semua tab button
                tabs.forEach(activeTab => activeTab.classList.remove(activeClass));
                //document.querySelectorAll('.tab-content').forEach(activeTab => activeTab.classList.remove(activeClass));
                //menghapus hidden class dari clicked tab-content
                targetContent.classList.remove('hidden');
                //menambah class aktif ke click tab button
                tab.classList.add(activeClass)
            });
        });

        cancelButton.addEventListener('click', () => {
            form.reset();
            document.querySelector('#tab1').classList.remove('hidden');
            document.querySelector('#tab2').classList.add('hidden');
            tabs[0].classList.add(activeClass);
            tabs[1].classList.remove(activeClass);
        });
    </script>
</x-layout>
