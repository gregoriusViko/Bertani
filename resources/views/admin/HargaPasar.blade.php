<x-layout>
    <x-slot:title>Admin-Harga Pasar-Bertani.com</x-slot:title>

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-black py-6 text-center">Harga Pasar Terbaru</h1>
        <div class="flex justify-end place-items-end mb-5">
            <a href="{{ route('admin.editHargaPasar') }}">
                <button id="buttonEdit"
                    class="px-4 py-1 shadow-md bg-blue-500 text-white hover:bg-black rounded-lg">Edit</button>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        @php
            $currentCategory = null;
        @endphp

        <div class="space-y-8">
            @forelse ($categories as $category)
                @if ($category->category !== $currentCategory)
                    @if (!is_null($currentCategory))
        </div> <!-- Close the previous category's items container -->

    </div> <!-- Close the previous category's card -->
    @endif

    <!-- New category card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden ">
        <h2 class="text-2xl font-semibold text-black bg-gray-100 border border-green-600 rounded-t-lg px-6 py-4">
            {{ ucfirst($category->category) }}
        </h2>
        <div class="divide-y divide-gray-200">
            @php
                $currentCategory = $category->category;
            @endphp
            @endif

            <!-- Category item -->
            <div class="flex items-center justify-between px-6 py-4">
                <div>
                    <div class="text-gray-800 font-medium">{{ ucfirst($category->name) }}</div>
                    <div class="text-sm text-gray-500">
                        Terakhir diperbarui: {{ \Carbon\Carbon::parse($category->updated_at)->format('d M Y, H:i') }}
                    </div>
                </div>
                <div class="text-gray-600 font-medium">Rp {{ number_format($category->market_price, 0, ',', '.') }}
                </div>

            </div>
        @empty
            <p class="text-center text-gray-600">Tidak ada data harga pasar.</p>
            @endforelse

            <!-- Close the last category -->
            @if (!is_null($currentCategory))
        </div> <!-- Close the last category's items container -->
    </div> <!-- Close the last category's card -->
    @endif

    @if (session('successUpdatePasar'))
        <div id="successMessage" class="fixed inset-0  bg-opacity-50 flex justify-center items-center z-50">
            <x-Message-success message="{{ session('successUpdatePasar') }}">
                Harga Produk telah diupdate dengan sukses.
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif
    {{-- message ketika sukses untuk menambah dan atau mengupdate produk --}}
    {{-- @if (session('successUpdatePasar') || true)
        <div id="successMessage" class="fixed inset-0 bg-gray-900 h-screen bg-opacity-50 flex justify-center items-center z-[99999]">
            <x-Message-success message="{{ session('Sukses') }}">
                Data harga pasar berhasil terupdate
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif --}}


    <script>
        // Function to close the message component
        function closeMessage(elementId) {
            const messageElement = document.getElementById(elementId);
            if (messageElement) {
                messageElement.style.display = 'none';
                document.body.style.overflow = '';
            }
        }


        // Hilangkan pesan secara otomatis setelah 3 detik
        window.onload = function() {
            const messageElement = document.getElementById('successMessage');
            if (messageElement) {
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    closeMessage('successMessage');
                }, 3000); 
            }

            // Hilangkan pesan error setelah 3 detik
            const errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    closeMessage('errorMessage');
                }, 3000); 
            }
        };
    </script>
</x-layout>
