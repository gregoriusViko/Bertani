<x-layout>
    <x-slot:title>Laporan Penjualan-Bertani.com</x-slot:title>
    <div dir="ltr">
        <div class="mb-4 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-libre-franklin font-bold tracking-tight text-gray-900">Laporan Penjualan</h1>
        </div>
    </div>

    <div class="grid grid-rows-8 grid-flow-col gap-4">
        <div class=" row-span-8  flex justify-center items-center">
            <div class="text-center">
                <h1 class="font-libre-franklin text-lg font-normal">Total Produk Terjual</h1>
                <h4 class="font-libre-franklin text-2xl font-bold">xx</h4>
            </div>
        </div>
        <div class="row-span-4 col-span-2 flex justify-center items-center">
            <div class="text-center">
                <h1 class="font-libre-franklin font-normal text-lg">Total Pemasukan</h1>
                <h4 class="font-libre-franklin text-2xl font-bold">xx</h4>
            </div>
        </div>
        <div class="row-span-4 col-span-2 flex justify-center items-center">
            <div class="text-center">
                <h1 class="font-libre-franklin font-normal text-lg">Produk Terlaku</h1>
                <h4 class="font-libre-franklin text-2xl font-bold">xx</h4>
            </div>
        </div>
    </div>



    <div class="mt-8 overflow-x-auto overflow-y-auto max-h-[400px] md:max-h-none md:overflow-hidden">
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
                <tr>
                    <th scope="col" class="px-6 py-3">
                        1
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Senin 11/11/2024 - 16.53
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kentang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        5000
                    </th>
                    <th scope="col" class="px-6 py-3">
                        100
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rp 500000
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cash
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mamat
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        2
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Senin 11/11/2024 - 16.53
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kentang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        5000
                    </th>
                    <th scope="col" class="px-6 py-3">
                        100
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rp 500000
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cash
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mamat
                    </th>
                </tr>
                {{-- @foreach ($produkList as $produk)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $produk->id }}</td>
                        <td class="px-6 py-4">{{ $produk->tanggal_waktu }}</td>
                        <td class="px-6 py-4">{{ $produk->nama_produk }}</td>
                        <td class="px-6 py-4">{{ $produk->harga_produk }}</td>
                        <td class="px-6 py-4">{{ $produk->jumlah }}</td>
                        <td class="px-6 py-4">{{ $produk->total_pembelian }}</td>
                        <td class="px-6 py-4">{{ $produk->metode_pembelian }}</td>
                        <td class="px-6 py-4">{{ $produk->nama_pembeli }}</td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>




</x-layout>
