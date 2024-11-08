<x-layout>
    <x-slot:title>Tambah Produk-Bertani.com</x-slot:title>
    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Tambah Produk</h1>
    </div>

    <div class="mt-4">
        {{-- <form method="POST" action="{{ route('products.store') }}"> --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="border border-red-400">
                Gambar
            </div>
            <div>


                <form method="POST">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                            :value="old('nama')" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2 " />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="Stok" :value="__('Stok')" />
                        <x-text-input id="Stok" class="block mt-1 w-9/12" type="number" name="Stok"
                            :value="old('Stok')" x-mask:dynamic="$Stok($input, ',')" required />
                        <x-input-error :messages="$errors->get('Stok')" class="mt-2 " />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('Harga')" />
                        <x-text-input id="harga" class="block mt-1 w-full" type="text" name="harga"
                            :value="old('harga')" x-mask:dynamic="$money($input, ',')" required />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2 " />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <x-text-area id="deskripsi" class="block mt-1 w-full" type="text"
                            name="deskripsi">{{ old('deskripsi') }}</x-text-area>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    {{-- <x-primary-button class="justify-center w-full mt-4">
                {{ __('Submit') }}
            </x-primary-button> --}}


                </form>
            </div>
        </div>
    </div>

</x-layout>
