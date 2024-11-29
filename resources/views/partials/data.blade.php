<div id="sub-tab1-1" class="sub-tab-content p-3">
    <h2 class=" font-semibold mb-3 text-sm md:text-lg">Visualisasi Pemasukan</h2>
    <div id="lineContainer">
        @include('partials.chart-line')
    </div>
    <h2 class=" font-semibold mt-4 mb-3 text-sm md:text-lg">Visualisasi Stok Barang Terjual</h2>
    <div id="barContainer">
        @include('partials.chart-pie')
    </div>
</div>
<div id="sub-tab1-2" class="sub-tab-content hidden ">
    <div class="m-3 overflow-x-auto">
        @include('partials.report-table')
    </div>

</div>