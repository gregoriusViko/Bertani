<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <title>Pesanan-Bertani.com</title>
</head>
<body>
     -->
<x-layout>
    <x-slot:title>Admin-Edit Harga Pasar-Bertani.com</x-slot:title>

    <p class="text-black text-3xl font-bold py-8">Edit Harga Pasar</p>

    <form enctype="multipart/form-data" class="max-w-md" method="POST" action="{{route('admin.updateHargaPasar')}}">
    @csrf

    {{--Dropdown Jenis Produk--}}

    <label for="jenis" class="block mb-2 text-xl font-medium text-black">Jenis Produk</label>
        <select name="categoryDropdown" id="jenis" class="block w-full p-2 mb-6 text-sm text-black border border-gray-300 rounded-lg bg-white focus:border-green-600" required>
            <option disabled selected>Pilih Jenis Produk</option>
            @if(isset($categories) && $categories->count() > 0)
    @foreach ($categories as $category)
        <option value="{{ $category->category }}">{{ $category->category }}</option>
    @endforeach
@else
    <option disabled>Tidak ada kategori tersedia</option>
@endif


        </select>

        {{-- Dropdown Nama Produk --}}
        <label for="namaProduk" class="block mb-2 text-xl font-medium text-black">Nama Produk</label>
        <select name="nama" id="productDropdown" class="block w-full p-2 mb-6 text-sm text-black border border-gray-300 rounded-lg bg-white focus:border-green-600" required>
            <option selected disabled>Pilih Nama Produk</option>
            <!-- Nama produk akan diisi secara dinamis melalui JavaScript -->
        </select>


        {{-- Input Harga --}}
        <label for="harga" class="block mb-2 text-xl font-medium text-black">Harga</label>
        <input type="text" name="harga" id="harga" placeholder="Masukkan harga baru"
            class="px-4 py-3 bg-white text-black w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" required />

        {{-- Tombol Submit --}}
        <button type="submit" id="updateharga"
            class="mt-5 mb-8 px-5 py-3 w-auto bg-green-500 hover:bg-green-300 text-white font-bold text-sm rounded-lg tracking-wide">Perbarui Harga</button>
    </form>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById(id);
            dropdownMenu.classList.toggle("hidden");
        }

        document.getElementById("jenis").addEventListener("change", function() {
            const selectedCategory = this.value;

            // Mengambil data produk berdasarkan kategori melalui AJAX
            fetch(`/products/get-by-category/${selectedCategory}`)
                .then(response => response.json())
                .then(data => {
                    const productDropdown = document.getElementById("productDropdown");
                    productDropdown.innerHTML = '<option disabled selected>Pilih Nama Produk</option>';

                    // Tambahkan produk ke dropdown nama produk
                    for (const [id, name] of Object.entries(data)) {
                        const option = document.createElement("option");
                        option.value = id;
                        option.textContent = name;
                        productDropdown.appendChild(option);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
</script>


</x-layout>
