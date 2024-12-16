<x-layout>
    <x-slot:title>Pembayaran Product-Bertani.com</x-slot:title>

    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Pembayaran</h1>
    </div>
    <input type="hidden" name="buyer_id" value="{{ $order->buyer_id }}">
    <input type="hidden" name="product_id" value="{{ $order->product_id }}">
    <input type="hidden" name="price" value="{{ $order->product->price }}">
    <input type="hidden" name="quantity_kg" value="{{ $order->quantity_kg }}">
    <input type="hidden" name="payment_method" value="{{ $order->payment_proof }}">

    <div class="mb-4">
        <table class="w-full border border-black rounded-md text-sm md:text-base" id="tabel">
            <thead class="uppercase bg-gray-300 border border-black">
                <tr>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base" id="kolom1">Nama Produk</th>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base" id="kolom2">Jumlah</th>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base" id="kolom3">Harga Satuan</th>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base" id="kolom4">Total Harga</th>
                </tr>
                <hr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base capitalize" id="baris1">
                        {{ $order->product->type->name }}</th>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base" id="baris2">
                        {{ $order->quantity_kg }} kg</th>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base" id="baris3">Rp
                        {{ number_format($order->product->price, 0, ',', '.') }}</th>
                    <th scope="col" class="px-1 py-1 md:px-6 md:py-3 text-base" id="baris4">Rp
                        {{ number_format($order->product->price * $order->quantity_kg, 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-2 border border-black border-r-black rounded-md ">
        <div class="border border-b-black">
            <div class="grid grid-cols-2 grid-rows-2 font-inter  my-3 mx-2">
                <h3 id="labelmetod"
                    class="font-semibold flex md:col-start-1 row-start-1 col-span-2 md:row-start-1 justify-start lg:ml-5 lg:text-lg md:text-base text-sm">
                    Metode Pembayaran</h3>
                <h3 id="metodbayar"
                    class="font-medium ml-5 md:ml-0 md:text-base text-sm row-start-2 col-span-2 md:col-start-2 md:row-start-1 lg:text-lg">
                    {{ $order->payment_proof }}</h3>
                <h3 id="labeltotbayar"
                    class="font-semibold flex justify-start row-start-3 lg:ml-5 md:text-base text-sm md:row-start-2 md:col-start-1 lg:text-lg">
                    Total Bayar</h3>
                <h3 id="nominal"
                    class="font-medium  ml-5 md:ml-0 md:text-base text-sm row-start-4 col-span-2 md:row-start-2 md:col-start-2 lg:text-lg">
                    Rp {{ number_format($order->product->price * $order->quantity_kg, 0, ',', '.') }}</h3>
            </div>
        </div>



        <div class="border border-l-black border-b-black">
            <div class="grid grid-flow-row font-inter my-3 mx-2">
                <h2 id="labelalamat"
                    class="flex items-center justify-center font-semibold  md:text-base text-sm lg:text-lg">Alamat
                    Pengambilan
                    barang</h2>
                <div class="flex items-start justify-start md:mt-0 mt-1 md:items-center md:justify-center">
                    <ion-icon name="location-outline" class="text"></ion-icon>
                    <a href="{{ $product->farmer->home_address }}" id="alamatpetani">
                        <h4 id="alamatPetani"
                            class="font-inter text-sm md:text-base font-normal lg:text-lg ml-1 hover:underline">
                            {{ $product->farmer->home_address }}</h4>
                    </a>
                </div>
            </div>
        </div>

        @if ($order->payment_proof === 'Transfer')

            @if (!empty($order->product->farmer->nomor_rekening))
                <div class="border">
                    <div class="ml-4 grid grid-flow-row font-inter  my-3 mx-2">
                        <h2 id="labeltf" class="font-semibold  md:text-base text-sm lg:text-lg">Transfer ke rekening :
                        </h2>
                        <h3 class="font-normal  md:text-base text-sm lg:text-lg" id="informasiTransfer">
                            {{ $order->product->farmer->bank }} -
                            {{ $order->product->farmer->nomor_rekening }} a.n {{ $order->product->farmer->name }}</h3>
                    </div>
                </div>
            @endif
            <div class="border border-l-black">
                <div class="ml-4 grid grid-flow-row font-inter font-normal my-3 mx-2">
                    <form action="{{ route('order.finish', $order->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <label id="labelupload" for="bukti-transfer"
                            class="block  md:text-base text-sm font-medium text-gray-700 mb-2">
                            Upload Bukti Transfer Pembayaran
                        </label>
                        <input type="file" id="bukti-transfer" name="bukti_transfer" accept="image/*"
                            class="block w-full md:w-1/2 text-sm text-gray-500 border border-gray-300 rounded-r-md cursor-pointer bg-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        <button id="submitTF"
                            class="my-2 w-full md:w-1/2 text-white text-sm md:text-md bg-green-600 py-1 rounded-md hover:bg-green-400"
                            type="submit">
                            Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Pembayaran COD -->
        @if ($order->payment_proof === 'COD')
            <div class="col-span-2">
                <div class="ml-4 grid grid-flow-row font-inter my-3 mx-2">
                    {{-- <h2 class="font-semibold">Metode Pembayaran: COD</h2> --}}
                    <p id="labelperintah" class="font-normal md:text-base text-sm lg:text-lg">Silahkan lakukan
                        pembayaran secara tunai
                        ketika anda mengambil barang di
                        petani.</p>
                    <form action="{{ route('order.finish', ['orderId' => $order->id]) }}"method="POST">
                        @csrf
                        <button id="submitCOD"
                            class="my-2 w-full md:w-1/2 text-white text-sm bg-green-600 py-1 md:px-0 px-1 rounded-md hover:bg-green-400"
                            type="submit">
                            Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        @endif

</x-layout>
