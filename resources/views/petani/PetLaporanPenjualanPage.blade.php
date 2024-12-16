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
            data-tab-target="#tab1" value="3">3 Bulan</button>
        <button class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab2" value="6">6
            Bulan</button>
        <button class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab3" value="9">9
            Bulan</button>
        <button class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab3" value="12">12
            Bulan</button>
            <button class="tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
            data-tab-target="#tab3" value="all">Semua</button>
    </div>

    <!-- Konten untuk Tab Utama -->
    <div class="tabs-content  border border-black rounded-md p-2">
        <!-- Konten Tab parent -->

        {{-- input bulan --}}
        <div class="my-3">
            {{-- jika tab[0] --}}
            {{-- <div class="grid grid-flow-col gap-x-2">
                <div class="">
                    <x-input-label for="awalBulan" :value="__('Pilih Awal Bulan')" />
                    <select id="categoryDropdown" name="awalBulan"
                        class="block w-full  pl-3 pr-3 py-1  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md"
                        required>
                        <option disabled selected class="hover:bg-green-600">Bulan</option>
                        <option class="bg-white hover:bg-green-600" value=""></option>
                    </select>
                </div>
                <div class="flex mt-5 mr-9">
                    <button class="w-full md:w-3/6 h-8 bg-blue-400 text-white hover:bg-green-500 rounded-md text-sm py-1 px-1 md:px-1">OK</button>
                </div>
            </div> --}}
           

            {{-- jika tab[1] && tab[2] --}}
            {{-- <div class="grid grid-flow-col gap-x-2">
                <div class="">
                    <x-input-label for="awalBulan" :value="__('Pilih Awal Bulan')" />
                    <select id="categoryDropdown" name="awalBulan"
                        class="block w-full  pl-3 pr-3 py-1  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md"
                        required>
                        <option disabled selected class="hover:bg-green-600">Bulan</option> --}}
                        {{-- @foreach ($categories as $category) --}}
                        {{-- <option class="bg-white hover:bg-green-600" value=""></option> --}}
                        {{-- @endforeach --}}
                    {{-- </select>
                </div>
                <div class="">
                    <x-input-label for="akhirBulan" :value="__('Pilih Akhir Bulan')" />
                    <select id="categoryDropdown" name="akhirBulan"
                        class="block w-full pl-3 pr-3 py-1  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md"
                        required>
                        <option disabled selected class="hover:bg-green-600">Bulan</option> --}}
                        {{-- @foreach ($categories as $category) --}}
                        {{-- <option class="bg-white hover:bg-green-600" value=""></option> --}}
                        {{-- @endforeach --}}
                    {{-- </select>
                </div>
                <div class="flex mt-5">
                    <button class="w-full md:w-3/4 h-8 bg-blue-400 text-white hover:bg-green-500 rounded-md text-sm py-1 px-2 md:px-1">OK</button>
                </div> --}}
            {{-- </div> --}}

        </div>
        <div id="tab" class="tab-content">
            <!-- Sub-tab Header -->
            <div class="sub-tabs-header flex border-b border-gray-300">
                <button
                    class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200 active"
                    data-sub-tab-target="#sub-tab1">Diagram</button>
                <button
                    class="sub-tab-btn px-4 py-2 rounded-lg text-sm md:text-lg text-black font-medium hover:bg-gray-200"
                    data-sub-tab-target="#sub-tab2">Tabel</button>
            </div>

            <!-- Sub-tab Content -->
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
