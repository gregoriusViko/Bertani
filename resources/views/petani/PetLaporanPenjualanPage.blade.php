<x-layout>
    <x-slot:title>Laporan Penjualan-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mb-4 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-libre-franklin font-bold tracking-tight text-gray-900">Laporan Penjualan</h1>
        </div>
    </div>

    @php
        $index = 1;
        $product = null;
        $total = 0;
        if ($orders->count() > 0) {
            $maxQuantityOrder = $orders->sortByDesc('quantity_kg')->first();

            // Mengakses produk terkait
            $product = $maxQuantityOrder->product;
            $total = $orders->sum(function ($order) {
                return $order->price * $order->quantity_kg; // Mengalikan harga dengan jumlah
            });
        }
    @endphp
    {{-- <div class="grid grid-rows-8 grid-flow-col gap-4"> --}}

    {{-- <div class=" row-span-8  flex justify-center items-center">
            <div class="text-center">
                <h1 class="font-libre-franklin text-lg font-normal">Total Produk Terjual</h1>
                <h4 class="font-libre-franklin text-2xl font-bold">{{ $orders->count() }}</h4>
            </div>
        </div>
        <div class="row-span-4 col-span-2 flex justify-center items-center">
            <div class="text-center">
                <h1 class="font-libre-franklin font-normal text-lg">Total Pemasukan</h1>
                <h4 class="font-libre-franklin text-2xl font-bold">{{ Number::currency($total, in: 'idr') }}</h4>
            </div>
        </div>
        <div class="row-span-4 col-span-2 flex justify-center items-center">
            <div class="text-center">
                <h1 class="font-libre-franklin font-normal text-lg">Produk Terlaku</h1>
                <h4 class="font-libre-franklin text-2xl font-bold">
                    {{ $product ? $product->type->name : 'Tidak Ada' }}</h4>
            </div>
        </div> --}}
    </div>

    {{-- button parent --}}
    <div class="mt-4">
        <button type="button" class="px-4 py-3 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
            data-tab-target="#tab1">Grafik Laporan</button>
        <button type="button" class="px-4 py-3 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
            data-tab-target="#tab2">Laporan Bulanan</button>
    </div>

    <div id="tab1"
        class="tab-content border rounded-md border-black overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
        <div class="p-3">
            <div class="p-4  rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Monthly Report</h2>
                <div id="chart-container" class="w-full"></div>
            </div>
            <div id="diagram">
                <canvas id="barChart" class="w-full h-96"></canvas>
            </div>
            {{-- niatnya diagram batang --}}
        </div>

    </div>

    {{-- Laporan --}}
    <div id="tab2"
        class="tab-content border border-black p-8 w-full h-auto hidden rounded-md overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
        {{-- <p class="text-2xl font-bold">Daftar Laporan</p> --}}
        {{-- button child laporan bulanan --}}
        <div class="pl-3">
            <button type="button" class="px-4 py-2 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
                data-nested-tab-target="#tab1bulan">1 Bulan</button>
            <button type="button" class="px-4 py-2  rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
                data-nested-tab-target="#tab3bulan">3 Bulan</button>
            <button type="button" class="px-4 py-2 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
                data-nested-tab-target="#tab6bulan">6 Bulan</button>
        </div>
        {{-- 1bulan --}}
        <div id="tab1bulan"
            class="nested-tab-content hidden border-t  border-black overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
            <x-input-label for="jenis" class="mt-3 ml-24" :value="__('Laporan Bulanan')" />
            <div class="flex justify-center items-center">
                <select id="categoryDropdown" name="jenis"
                    class="justify-center block m-3 w-3/4 pl-3 pr-3 py-2  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md"
                    required>
                    <option disabled selected class="hover:bg-green-600">Pilih Bulan </option>
                    {{-- @foreach ($categories as $category) --}}
                    <option class="bg-white hover:bg-green-600" value=" "> </option>
                    {{-- @endforeach --}}
                </select>
                <button class="text-white bg-blue-600 hover:bg-orange-400 rounded-md px-4 py-2">OK</button>
            </div>
            {{-- tabel --}}
            <div class="m-3 overflow-x-auto">
                <x-report-table id="tab1bulan" :orders="$orders" :product="$product" />
            </div>
        </div>

        {{-- 3bulan --}}
        <div id="tab3bulan"
            class="nested-tab-content hidden border-t  border-black overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
            <x-input-label for="jenis" class="mt-3 ml-24" :value="__('Laporan 3 Bulanan')" />
            <div class="flex justify-center items-center">
                <select id="categoryDropdown" name="jenis"
                    class="justify-center block m-3 w-3/4 pl-3 pr-3 py-2  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md"
                    required>
                    <option disabled selected class="hover:bg-green-600">Pilih Awal Bulan </option>
                    {{-- @foreach ($categories as $category) --}}
                    <option class="bg-white hover:bg-green-600" value=" "> </option>
                    {{-- @endforeach --}}
                </select>
                <button class="text-white bg-blue-600 rounded-md px-4 py-2">OK</button>
            </div>
            {{-- tabel --}}
            <div class="m-3 overflow-x-auto">
                <x-report-table id="tab3bulan" class="" :orders="$orders" :product="$product" />
            </div>
        </div>
        {{-- 6bulan --}}
        <div id="tab6bulan"
            class="nested-tab-content hidden border-t  border-black overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
            <x-input-label for="jenis" class="mt-3 ml-24" :value="__('Laporan 6 Bulanan')" />
            <div class="flex justify-center items-center">
                <select id="categoryDropdown" name="jenis"
                    class="justify-center block m-3 w-3/4 pl-3 pr-3 py-2  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md"
                    required>
                    <option disabled selected class="hover:bg-green-600">Pilih Awal Bulan </option>
                    {{-- @foreach ($categories as $category) --}}
                    <option class="bg-white hover:bg-green-600" value=" "> </option>
                    {{-- @endforeach --}}
                </select>
                <button class="text-white bg-blue-600 rounded-md px-4 py-2">OK</button>
            </div>
            {{-- tabel --}}
            <div class="m-3 overflow-x-auto">
                <x-report-table id="tab6bulan" :orders="$orders" :product="$product" />
            </div>
        </div>
    </div>


    <script>
        const tabs = document.querySelectorAll('[data-tab-target]');
        const activeClass = "bg-green-500";
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

        const nestedTabs = document.querySelectorAll('#tab2 [data-nested-tab-target]');
        const nestedActiveClass = "bg-green-500";

        // Pastikan ada nested tabs
        if (nestedTabs.length > 0) {
            // Tab default untuk nested tabs
            const defaultTab = nestedTabs[0];
            const defaultContent = document.querySelector(defaultTab.dataset.nestedTabTarget);

            defaultTab.classList.add(nestedActiveClass); // Tambahkan class aktif pada tab pertama
            defaultContent?.classList.remove('hidden'); // Tampilkan konten tab pertama

            // Event listener untuk nested tabs
            nestedTabs.forEach(nestedTab => {
                nestedTab.addEventListener('click', () => {
                    const targetNestedContent = document.querySelector(nestedTab.dataset.nestedTabTarget);

                    // Sembunyikan semua konten nested tabs di dalam #tab2
                    document.querySelectorAll('#tab2 .nested-tab-content').forEach(content => content
                        .classList.add('hidden'));

                    // Hilangkan active class dari semua nested tabs
                    nestedTabs.forEach(tab => tab.classList.remove(nestedActiveClass));

                    // Tampilkan konten tab yang diklik
                    targetNestedContent?.classList.remove('hidden');

                    // Tambahkan active class ke nested tab yang diklik
                    nestedTab.classList.add(nestedActiveClass);
                });
            });
        }


        cancelButton.addEventListener('click', () => {
            form.reset();
            document.querySelector('#tab1').classList.remove('hidden');
            document.querySelector('#tab2').classList.add('hidden');
            tabs[0].classList.add(activeClass);
            tabs[1].classList.remove(activeClass);
        });
    </script>

    <script src="path/to/chartjs/dist/chart.umd.js"></script>


    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


</x-layout>
