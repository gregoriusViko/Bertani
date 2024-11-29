<x-layout>
    <x-slot:title>Pembayaran Product-Bertani.com</x-slot:title>

    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Pembayaran</h1>
    </div>

    <form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="buyer_id" value="{{ $order->buyer_id}}">
        <input type="hidden" name="product_id" value="{{ $order->product_id}}">
        <input type="hidden" name="price" value="{{ $order->product->price }}">
        <input type="hidden" name="quantity_kg" value="{{ $order->quantity_kg }}">
        <input type="hidden" name="payment_method" value="{{ $order->payment_proof }}">

    <div class="mb-4">
        <table class="w-full border border-black rounded-md text-sm md:text-base">
            <thead class="uppercase bg-gray-300 border border-black">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Produk</th>
                    <th scope="col" class="px-6 py-3">Jumlah</th>
                    <th scope="col" class="px-6 py-3">Harga Satuan</th>
                    <th scope="col" class="px-6 py-3">Total Harga</th>
                </tr>
                <hr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col" class="px-6 py-3">"{{ $order->product->type->name}}"</th>
                    <th scope="col" class="px-6 py-3">"{{ $order->quantity_kg}}" kg</th>
                    <th scope="col" class="px-6 py-3">Rp {{number_format($order->product->price, 0, ',', '.')}}</th>
                    <th scope="col" class="px-6 py-3">Rp {{number_format($order->product->price * $order->quantity_kg, 0 , ',' , '.')}}</th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-2 border border-black rounded-md ">
        <div class="border border-b-black">
            <div class="grid grid-cols-2 font-inter font-semibold my-3 mx-2">
                <h3 class="flex justify-center">Metode Pembayaran</h3>
                <h3>{{ $order->payment_proof }}</h3>
                <h3 class="flex justify-center -ml-3">Total Bayar</h3>
                <h3>Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="border border-b-black border-l-black">
            <div class="ml-4 grid grid-flow-row font-inter  my-3 mx-2">
                <h2 class="font-semibold">Transfer ke rekening :</h2>
                <h3 class="font-normal">"BANK - NOREK || NAMA"</h3>
            </div>
        </div>

        <div class="">
            <div class="grid grid-flow-row font-inter my-3 mx-2">
                <h2 class="flex items-center justify-center font-semibold">Alamat Pengambilan barang</h2>
                <div class="flex items-center justify-center">
                    <ion-icon name="location-outline"></ion-icon><span><h3 class="font-normal">{{ $order->product->farmer->home_address }}</h3></span>
                </div>
            </div>
        </div>

        <div class="border border-l-black">
            <div class="ml-4 grid grid-flow-row font-inter font-normal my-3 mx-2">
                <label for="bukti-transfer" class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Transfer Pembayaran</label>
                <input type="file" id="bukti-transfer" name="bukti_transfer" accept="image/*" class="block lg:w-3/4 w-3/4 text-sm text-gray-500 border border-gray-300 rounded-r-md cursor-pointer bg-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                <button class="my-2 lg:w-3/4 w-3/4 text-white text-sm md:text-md bg-green-600 py-1 rounded-md hover:bg-green-400" type="submit">Konfirmasi Pesanan</button>
            </div>
        </div>
    </form>
</x-layout>
