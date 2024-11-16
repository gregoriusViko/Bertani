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
                    {{ $product ? $product->type->category : 'Tidak Ada' }}</h4>
            </div>
        </div>
    </div>



    <div class="mt-8 overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
        @if ($product)
            <table class="w-full text-sm text-left rtl:text-right text-black border border-black">
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
                                {{ $order->product->type->category }}
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




</x-layout>
