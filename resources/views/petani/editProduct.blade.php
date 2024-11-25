<x-layout>
    <x-slot:title>Edit Produk-Bertani.com</x-slot:title>
    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Edit Produk</h1>

    </div>
    
    <div class="mt-4 px-7 mx-auto max-w-screen-lg" x-data="{ imageUrl: '/img/noimage.png' }">
        <form enctype="multipart/form-data" method="POST" action="{{route('product.update', $product->slug)}}" class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-7 mx-auto max-w-full">
            @csrf
            @method('PUT')
            {{-- kiri gambar --}}
            <div>
                <img src="{{ $product->foto ? asset($product->foto) : '/img/noimage.png' }}" class="rounded-md border-2 md:w-full w-[400px] h-[300px] object-contain shadow-md" alt="Foto Produk">
                <div class="mt-4">
                    <div class="flex justify-between">
                        <x-input-label for="foto" :value="__('Ganti Foto (opsional)')" class="items-center" />
                        <div class="">
                            <button type="submit" name="delete_photo" value="1" class="px-1 py-1 bg-red-600 text-white rounded-lg hover:bg-red-400 text-sm">Hapus Foto</button>
                        </div>
                    </div>
                   
                    <input id="foto" name="foto" type="file" accept="image/*" class="block mt-1 w-full border p-2 rounded-md shadow-md">
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>
                
            </div>
            {{-- kanan --}}
            <div>
                <!-- Jenis Produk Dropdown Hanya tampilan-->
                <div class="relative">
                    <x-input-label for="jenis" :value="__('Jenis Produk')" />
                    <x-text-input id="jenis" class="block mt-1 w-full border-gray-300 rounded-lg bg-gray-100" 
                            value="{{ $product->type->category }}" readonly />
                </div>

                <!-- Nama Produk Dropdown Hanya Tampilan-->
                <div class="mt-4 relative">
                    <x-input-label for="nama" :value="__('Nama Produk')" />
                    <x-text-input id="nama" class="block mt-1 w-full border-gray-300 rounded-lg bg-gray-100" 
                            value="{{ $product->type->name }}" readonly />
                </div>
                {{-- jumlah stok --}}
                <div class="mt-4 relative">
                    <x-input-label for="Stok" :value="__('Jumlah Stok')" />
                    <x-text-input id="Stok" class="block mt-1  border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 w-full" type="number" name="stok"
                        :value="old('Stok')" x-mask:dynamic="$Stok($input, ',')" required />
                    <x-input-error :messages="$errors->get('Stok')" class="mt-2 " />
                </div>
                {{-- harga --}}
                <div class="mt-4 relative">
                    <x-input-label for="harga" :value="__('Harga')" />
                    <x-text-input id="harga" class="block mt-1 w-full border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50" type="text" name="harga"
                        :value="old('harga')" required />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>
                {{-- deskripsi --}}
                <div class="mt-4 relative">
                    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                    <x-text-area id="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50" type="text"
                        name="deskripsi">{{ old('deskripsi') }}</x-text-area>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>
                {{-- button --}}
                <div class="mt-4 flex space-x-2 justify-end">
                    <button class="items-end text-white bg-red-600 px-4 py-1 rounded-lg hover:bg-red-400 mr-2" type="button" id="cancel-button">BATAL</button>
                    <button class="item-end text-white bg-green-600 px-4 py-1 rounded-lg hover:bg-green-400" type="submit" id="save-button" >SIMPAN</button>
                </div>
            </div>
        </form>
    </div>

</x-layout>