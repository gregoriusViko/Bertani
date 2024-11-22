<div class="">
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
    

    <div class="flex justify-center gap-6 items-center mb-3">
        <div class="">
            <h1 class="font-libre-franklin font-normal text-sm md:text-lg">Total Pemasukan</h1>
            
        </div>
        <h4 class="font-libre-franklin text-sm md:text-lg font-bold">{{ Number::currency($total, in: 'idr') }}</h4>
    </div>
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
                        <th scope="col" class="px-6 py-3 ">
                            {{ $order->order_time->isoFormat('dddd D/MM/YYYY - HH.mm') }}
                        </th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                            {{ $order->product->type->name }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ Number::currency($order->price, in: 'idr') }}
                        </th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
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
