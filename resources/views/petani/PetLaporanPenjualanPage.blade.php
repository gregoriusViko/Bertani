<x-layout>
    <x-slot:title>Laporan Penjualan-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mb-4 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-libre-franklin font-bold tracking-tight text-gray-900">Laporan Penjualan</h1>
        </div>
    </div>

    <div class="grid grid-rows-8 grid-flow-col gap-4">
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
        <div class=" row-span-8  flex justify-center items-center">
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
        </div>
    </div>
    {{-- button parent --}}
    <div class="mt-4">
        <button type="button" class="p-4 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
            data-tab-target="#tab1">Laporan Bulanan</button>
        <button type="button" class="p-4 rounded-lg text-black font-medium flex-grow hover:bg-gray-200"
            data-tab-target="#tab2">Daftar Laporan</button>
    </div>

    <div id="tab1"
        class="tab-content border rounded-md border-black overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
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

            <div class="m-3">
                @if ($product)
                    <table class="rounded-md w-full text-sm text-left rtl:text-right text-black border border-black">
                        <thead class="text-xs text-white uppercase bg-blue-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Tanggal-Waktu</th>
                                <th scope="col" class="px-6 py-3">Nama Produk</th>
                                <th scope="col" class="px-6 py-3">Harga Produk</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Total Pembelian</th>
                                <th scope="col" class="px-6 py-3">Metode Pembelian</th>
                                <th scope="col" class="px-6 py-3">Nama Pembeli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $index }}
                                        @php
                                            $index += 1;
                                        @endphp
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $order->order_time->isoFormat('dddd D/MM/YYYY - HH.mm') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $order->product->type->name }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ Number::currency($order->price, in: 'idr') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ WeightConverter::convert($order->quantity_kg) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ Number::currency($order->price * $order->quantity_kg, in: 'idr') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ ucwords($order->payment_proof) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ strtok($order->buyer->name, ' ') }}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
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
            <div class="m-3">
                @if ($product)
                    <table class="rounded-md w-full text-sm text-left rtl:text-right text-black border border-black">
                        <thead class="text-xs text-white uppercase bg-blue-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Tanggal-Waktu</th>
                                <th scope="col" class="px-6 py-3">Nama Produk</th>
                                <th scope="col" class="px-6 py-3">Harga Produk</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Total Pembelian</th>
                                <th scope="col" class="px-6 py-3">Metode Pembelian</th>
                                <th scope="col" class="px-6 py-3">Nama Pembeli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $index }}
                                        @php
                                            $index += 1;
                                        @endphp
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $order->order_time->isoFormat('dddd D/MM/YYYY - HH.mm') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $order->product->type->name }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ Number::currency($order->price, in: 'idr') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ WeightConverter::convert($order->quantity_kg) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ Number::currency($order->price * $order->quantity_kg, in: 'idr') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ ucwords($order->payment_proof) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ strtok($order->buyer->name, ' ') }}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
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
            <div class="m-3">
                @if ($product)
                    <table class="rounded-md w-full text-sm text-left rtl:text-right text-black border border-black">
                        <thead class="text-xs text-white uppercase bg-blue-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Tanggal-Waktu</th>
                                <th scope="col" class="px-6 py-3">Nama Produk</th>
                                <th scope="col" class="px-6 py-3">Harga Produk</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Total Pembelian</th>
                                <th scope="col" class="px-6 py-3">Metode Pembelian</th>
                                <th scope="col" class="px-6 py-3">Nama Pembeli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $index }}
                                        @php
                                            $index += 1;
                                        @endphp
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $order->order_time->isoFormat('dddd D/MM/YYYY - HH.mm') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ $order->product->type->name }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ Number::currency($order->price, in: 'idr') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ WeightConverter::convert($order->quantity_kg) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ Number::currency($order->price * $order->quantity_kg, in: 'idr') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ ucwords($order->payment_proof) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ strtok($order->buyer->name, ' ') }}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>

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
                <button onclick=""><img src="/img/paperplane.png" alt="icon_teruskan" class="w-9 h-9"></button>
            </form>
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

        // Script untuk nested tabs di dalam #tab1
        const nestedTabs = document.querySelectorAll('#tab1 [data-nested-tab-target]');
        const nestedActiveClass = "bg-green-500";

        // Tab default untuk nested tabs
        nestedTabs[0]?.classList.add(nestedActiveClass); // Pastikan ada nestedTabs
        document.querySelector('#tab1bulan')?.classList.remove('hidden');

        // Event listener untuk nested tabs
        nestedTabs.forEach(nestedTab => {
            nestedTab.addEventListener('click', () => {
                const targetNestedContent = document.querySelector(nestedTab.dataset.nestedTabTarget);

                // Menambah hidden class untuk semua nested tab-content di dalam #tab1
                document.querySelectorAll('#tab1 .nested-tab-content').forEach(content => content.classList
                    .add('hidden'));

                // Menghapus active class dari semua nested tabs
                nestedTabs.forEach(activeNestedTab => activeNestedTab.classList.remove(nestedActiveClass));

                // Menghapus hidden class dari nested tab-content yang diklik
                targetNestedContent.classList.remove('hidden');

                // Menambah active class ke nested tab yang diklik
                nestedTab.classList.add(nestedActiveClass);
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
