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
    <div class="mt-4">
        <button id="3bln"
            class="tab-btn px-4 py-2 active rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab1" value="3">3 Bulan</button>
        <button id="6bln"
            class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab2" value="6">6
            Bulan</button>
        <button id="9bln"
            class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab3" value="9">9
            Bulan</button>
        <button id="12bln"
            class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab3" value="12">12
            Bulan</button>
        <button id="all"
            class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab3" value="all">Semua</button>
    </div>

    <!-- Konten untuk Tab Utama -->
    <div class="tabs-content  border border-black rounded-md p-2">
        <!-- Konten Tab parent -->
        <div id="tab" class="tab-content">
            <!-- Sub-tab Header -->
            <div class="sub-tabs-header flex border-b border-gray-300">
                <button id="tabdiagram"
                    class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200 active"
                    data-sub-tab-target="#sub-tab1">Diagram</button>
                <button id="tabTabel"
                    class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
                    data-sub-tab-target="#sub-tab2">Tabel</button>
            </div>

            <!-- Sub-tab Content (DIAGRAM) -->
            <div id="dataContainer" class="sub-tab-content mt-4 ">
                @include('partials.data')
            </div>
        </div>
    </div>




    <script>
        const activeClass = "bg-green-500"; // Kelas aktif untuk tab utama
        const nestedActiveClass = "bg-blue-500"; // Kelas aktif untuk sub-tab
        const tabs = document.querySelectorAll(".tab-btn");

        subTabs = document.querySelectorAll(".sub-tab-btn");
        subTabs[0].classList.add(nestedActiveClass);

        tabs[0].classList.add(activeClass);
        tabs.forEach(element => {
            element.addEventListener('click', () => {
                tabs.forEach(btn => btn.classList.remove(activeClass));
                element.classList.add(activeClass);
                loadOtherData(element.value);
            });
        });

        subTabs[0].addEventListener('click', () => {
            subTabs.forEach(btn => btn.classList.remove(nestedActiveClass));
            subTabs[0].classList.add(nestedActiveClass);
            document.getElementById('sub-tab1-1').classList.remove('hidden');
            document.getElementById('sub-tab1-2').classList.add('hidden');
        });
        subTabs[1].addEventListener('click', () => {
            subTabs.forEach(btn => btn.classList.remove(nestedActiveClass));
            subTabs[1].classList.add(nestedActiveClass);
            document.getElementById('sub-tab1-1').classList.add('hidden');
            document.getElementById('sub-tab1-2').classList.remove('hidden');
        });

        document.getElementById("categoryDropdown").addEventListener("change", function() {
            const selectedCategory = this.value;
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            line();
            pie();
        }

        function loadOtherData(bulan) {
            $.ajax({
                url: '/data-penjualan/load?bulan=' + bulan,
                type: "get",
                beforeSend: function() {
                    console.log('mendapatkan data...');
                }
            }).done(function(data) {
                if (data == "") {
                    $('#dataContainer').html("No more records found");
                    return;
                }
                $("#dataContainer").html(data);
                line();
                pie();

            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                $('#dataContainer').html("Sedang ada gangguan");
            });
        }
    </script>

</x-layout>
