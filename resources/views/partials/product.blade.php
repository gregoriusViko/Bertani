@foreach ($products as $product)
    <div class="shadow-lg border overflow-hidden rounded-lg grid-flow-row cursor-pointer" onclick="handleClick()">
        <img class="rounded-t-lg lg:w-72 lg:h-44 md:w-60 md:h-36 sm:w-32 sm:h-20 object-cover mb-1" src="./img/logo3.jpg"
            alt="">
        <div class="p-2 grid-cols-2">
            <div class="col-span-2 text-base font-mono">
                {{ $product->name }} - {{ WeightConverter::convert($product->selling_unit_kg) }}
            </div>
            <div class="text-xl font-mono font-bold">
                {{ Number::currency($product->price, in: 'idr') }}
            </div>
            <div class="text-sm font-mono font-light">
                {{ Str::before($product->farmer->name, ' ') }} - "asal"
            </div>
            <div class="text-sm font-mono font-light">
                Terjual : {{ WeightConverter::convert($product->orderDetails->sum('order_quantity')) }}
            </div>
            <div class="text-sm font-mono font-light">
                "Stok : {{ WeightConverter::convert($product->stock_kg) }}"
            </div>

        </div>
    </div>
@endforeach