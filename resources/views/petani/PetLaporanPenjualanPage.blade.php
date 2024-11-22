<x-layout mb-4>
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

    <div class="mt-4">
        <button class="tab-btn px-4 py-2 active rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab1">1 Bulan</button>
        <button class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200" data-tab-target="#tab2">3
            Bulan</button>
        <button class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200" data-tab-target="#tab3">6
            Bulan</button>
    </div>

    <!-- Konten untuk Tab Utama -->
    <div class="tabs-content  border border-black rounded-md p-2">
        <!-- Konten Tab 1 -->
        <div id="tab1" class="tab-content">
            <!-- Sub-tab Header -->
            <div class="sub-tabs-header flex border-b border-gray-300">
                <button class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200 active"
                    data-sub-tab-target="#sub-tab1-1">Diagram</button>
                <button class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
                    data-sub-tab-target="#sub-tab1-2">Tabel</button>
            </div>

            <!-- Sub-tab Content -->
            <div class="sub-tabs-content mt-4 ">
                <div id="sub-tab1-1" class="sub-tab-content p-3">
                    <h2 class=" font-semibold mb-3 text-sm md:text-lg">Visualisasi Pemasukan</h2>
                    <x-chart-line></x-chart-line>
                    <h2 class=" font-semibold mt-4 mb-3 text-sm md:text-lg">Visualisasi Stok Barang Terjual</h2>
                    <x-chart-batang></x-chart-batang>
                </div>
                <div id="sub-tab1-2" class="sub-tab-content hidden ">
                    <div class="m-3 overflow-x-auto">
                        <x-report-table id="tab3bulan" class="" :orders="$orders" :product="$product" />
                    </div>

                </div>
            </div>
        </div>

        <!-- Konten Tab 2 -->
        <div id="tab2" class="tab-content hidden">
            <!-- Sub-tab Header -->
            <div class="sub-tabs-header flex border-b border-gray-300">
                <button class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200 active"
                    data-sub-tab-target="#sub-tab2-1">Diagram</button>
                <button class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
                    data-sub-tab-target="#sub-tab2-2">Tabel</button>
            </div>

            <!-- Sub-tab Content -->
            <div class="sub-tabs-content mt-4">
                <div id="sub-tab2-1" class="sub-tab-content">
                    <h2 class=" font-semibold mb-3 text-sm md:text-lg">Visualisasi Pemasukan</h2>
                    <x-chart-line></x-chart-line>
                    <h2 class=" font-semibold mt-4 mb-3 text-sm md:text-lg">Visualisasi Stok Barang Terjual</h2>
                    <x-chart-batang></x-chart-batang>
                </div>
                <div id="sub-tab2-2" class="sub-tab-content hidden">
                    <div class="m-3 overflow-x-auto">
                        <x-report-table id="tab3bulan" class="" :orders="$orders" :product="$product" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Tab 3 -->
        <div id="tab3" class="tab-content hidden">
            <!-- Sub-tab Header -->
            <div class="sub-tabs-header flex border-b border-gray-300">
                <button class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg  text-black font-medium hover:bg-gray-200 active"
                    data-sub-tab-target="#sub-tab3-1">Diagram</button>
                <button class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg  text-black font-medium hover:bg-gray-200"
                    data-sub-tab-target="#sub-tab3-2">Tabel</button>
            </div>

            <!-- Sub-tab Content -->
            <div class="sub-tabs-content mt-4">
                <div id="sub-tab3-1" class="sub-tab-content">
                    <h2 class=" font-semibold mb-3 text-sm md:text-lg">Visualisasi Pemasukan</h2>
                    <x-chart-line></x-chart-line>
                    <h2 class=" font-semibold mt-4 mb-3 text-sm md:text-lg">Visualisasi Stok Barang Terjual</h2>
                    <x-chart-batang></x-chart-batang>
                </div>
                <div id="sub-tab3-2" class="sub-tab-content hidden">
                    <div class="m-3 overflow-x-auto">
                        <x-report-table id="tab3bulan" class="" :orders="$orders" :product="$product" />
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        const cancelButton = document.getElementById('cancelButton');

        
        const activeClass = "bg-green-500"; // Kelas aktif untuk tab utama
        const nestedActiveClass = "bg-blue-500"; // Kelas aktif untuk sub-tab

        document.addEventListener("DOMContentLoaded", () => {
            // Mengatur tab utama
            const tabs = document.querySelectorAll(".tab-btn");
            const tabContents = document.querySelectorAll(".tab-content");

            // Set tab utama pertama sebagai aktif saat halaman dimuat
            tabs[0].classList.add(activeClass);
            tabContents[0].classList.remove("hidden");

            // Set sub-tab pertama dalam tab utama pertama sebagai aktif
            const firstSubTabs = tabContents[0].querySelectorAll(".sub-tab-btn");
            const firstSubTabContents = tabContents[0].querySelectorAll(".sub-tab-content");

            firstSubTabs[0].classList.add(nestedActiveClass);
            firstSubTabContents[0].classList.remove("hidden");

            // Event listener untuk tab utama
            tabs.forEach(tab => {
                tab.addEventListener("click", () => {
                    const target = document.querySelector(tab.dataset.tabTarget);

                    // Reset semua tab utama
                    tabs.forEach(btn => btn.classList.remove(activeClass));
                    tabContents.forEach(content => content.classList.add("hidden"));

                    // Aktifkan tab utama yang diklik
                    tab.classList.add(activeClass);
                    target.classList.remove("hidden");

                    // Reset sub-tab di dalam tab utama yang baru diaktifkan
                    const subTabs = target.querySelectorAll(".sub-tab-btn");
                    const subTabContents = target.querySelectorAll(".sub-tab-content");

                    subTabs.forEach((subTab, index) => {
                        if (index === 0) {
                            subTab.classList.add(nestedActiveClass);
                            subTabContents[index].classList.remove("hidden");
                        } else {
                            subTab.classList.remove(nestedActiveClass);
                            subTabContents[index].classList.add("hidden");
                        }
                    });
                });
            });

            // Event listener untuk sub-tab
            const allSubTabs = document.querySelectorAll(".sub-tab-btn");
            allSubTabs.forEach(subTab => {
                subTab.addEventListener("click", () => {
                    const target = document.querySelector(subTab.dataset.subTabTarget);
                    const subTabContainer = subTab.closest(".tab-content");

                    // Reset semua sub-tab dalam tab utama yang aktif
                    const subTabs = subTabContainer.querySelectorAll(".sub-tab-btn");
                    const subTabContents = subTabContainer.querySelectorAll(".sub-tab-content");

                    subTabs.forEach(btn => btn.classList.remove(nestedActiveClass));
                    subTabContents.forEach(content => content.classList.add("hidden"));

                    // Aktifkan sub-tab yang diklik
                    subTab.classList.add(nestedActiveClass);
                    target.classList.remove("hidden");
                });
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

    {{-- <script src="path/to/chartjs/dist/chart.umd.js"></script>


    <script>
        
    </script> --}}


</x-layout>
