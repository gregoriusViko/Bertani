@foreach ($products as $product)
    <a href="/products/{{ $product->slug }}">
        <div class="shadow-lg border overflow-hidden rounded-lg grid-flow-row cursor-pointer" onclick="handleClick()">
            <img class="rounded-t-lg lg:w-72 lg:h-44 md:w-60 md:h-36 sm:w-32 sm:h-20 object-cover mb-1" src="{{ $product->img_link }}"
                alt="">
            <div class="p-2 grid-cols-2">
                <div class="col-span-2 text-base font-mono capitalize">
                    {{ ucwords($product->type->name) }}
                </div>
                <div class="text-xl font-mono font-bold">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
                <div class="text-sm font-mono font-light capitalize flex justify-start gap-x-2">
                    <img src="/img/chinese-farmer-svgrepo-com.png" alt="iconPetani" id="iconPetani" class="w-5 h-5"> <span>{{ Str::before($product->farmer->name, ' ')}}</span>
                </div>
                <div class="text-sm font-mono font-light">
                    Terjual : {{ WeightConverter::convert($product->orders->sum('quantity_kg')) }}
                </div>
                <div class="text-sm font-mono font-light">
                    Stok : {{ WeightConverter::convert($product->stock_kg) }}
                </div>
    
            </div>
        </div>
    </a>
@endforeach