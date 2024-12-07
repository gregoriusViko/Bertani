<x-layout>
    <x-slot:title>Profile-Bertani.com</x-slot:title>
    <!-- Kotak dengan konten -->
    <div class="bg-amber-100 text-white p-6 rounded-lg shadow-md max-w-xl items-center mx-auto mt-6">
        {{-- avatar --}}
        <div class="flex flex-col items-center">
            <div class="avatar mb-3 w-24 h-24">
                {{-- <div class="size-16 rounded-full border border-black"> --}}
                <img class="rounded-full object-cover w-24 h-24"
                    src="{{ $user->profile_img_link ? $user->profile_img_link : './img/orang.jpeg.jpg' }}" alt="avatar">
                {{-- </div> --}}
            </div>
            <h2 class="text-base font-libre-franklin font-bold text-black">{{ $user->email }}</h2>
            <h4 class="font-libre-franklin font-normal text-sm text-gray-700">{{ $role }}</h4>
        </div>

        <div id="notif-message" class="notif-message hidden">
            <x-Message-info>Silahkan perbarui data anda</x-Message-info>
        </div>

        {{-- form --}}
        <form class="mt-6 max-w-sm mx-auto " id="profile-form" action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="nama-input" class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Nama
                    Pengguna</label>
                <input type="text" id="nama-input" name="name"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{ $user->name }}" required readonly />
            </div>
            <div class="mb-5">
                <label for="alamat-input"
                    class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Alamat</label>
                <input type="text" id="alamat-input" name="home_address"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{ $user->home_address }}" required readonly />
            </div>
            <div class="mb-5">
                <label for="notelp-input" class="block mb-1 text-base font-libre-franklin font-semibold  text-black">No
                    Telepon</label>
                <input type="tel" id="notelp-input" name="phone_number"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ $user->phone_number }}" required readonly />
            </div>
            <div class="mb-5">
                <label for="email-input"
                    class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Email</label>
                <input type="text" id="email-input" name="email"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{ $user->email }}" required readonly />
            </div>

            @if (Auth::guard('farmer')->check())
                <div class="mb-5">
                    <label for="bank-input"
                        class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Bank</label>
                    <select id="bank-input" name="bank"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required readonly disabled>
                        <option value="BRI" {{ $user->bank === 'BRI' ? 'selected' : '' }}>BRI</option>
                        <option value="BNI" {{ $user->bank === 'BNI' ? 'selected' : '' }}>BNI</option>
                        <option value="Mandiri" {{ $user->bank === 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                        <option value="BCA" {{ $user->bank === 'BCA' ? 'selected' : '' }}>BCA</option>
                    </select>
                </div>

                <div class="mb-5">
                    <label for="rekening-input"
                        class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Nomor
                        Rekening</label>
                    <input type="text" id="rekening-input" name="nomor_rekening"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="{{ $user->nomor_rekening }}" required readonly />
                </div>
            @endif

        </form>
        {{-- button group --}}
        <div class="flex items-center justify-between mt-4">
            <form action="{{ route('profile.logout') }}" method="post">
                @csrf
                <button
                    class="text-white bg-gray-600 px-4 py-1 rounded-lg hover:bg-gray-400 flex items-center justify-center space-x-2"
                    type="submit">
                    <ion-icon name="log-out" class="text-2xl group-hover:text-green-600"></ion-icon>
                    <span class="group-hover:text-green-600">KELUAR</span>
                </button>
            </form>
            <div class="flex space-x-2">
                <button class="text-white bg-yellow-600 px-4 py-1 rounded-lg hover:bg-yellow-400 mr-2" type="button"
                    id="edit-button" onclick="toggleAllInputs()">EDIT</button>
                <button class="text-white bg-blue-600 px-4 py-1 rounded-lg hover:bg-blue-400" type="submit"
                    id="save-button" form="profile-form" disabled>SIMPAN</button>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('Sukses'))
            <div id="successMessage"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                <x-Message-success message="{{ session('Sukses') }}">
                    Profil telah diperbarui
                    <button onclick="closeMessage('successMessage')"
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                        <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                    </button>
                </x-Message-success>
            </div>
        @endif
        {{-- message ketika gagal menghapus produk --}}
        @if (session('Gagal'))
            <div id="errorMessage"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
                <x-Message-error message="{{ session('error') }}">
                    Terjadi kesalahan dalam update profile.
                    <button onclick="closeMessage('error')"
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                        <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                    </button>
                </x-Message-error>
            </div>
        @endif

    </div>
</x-layout>
<script>
    function toggleAllInputs() {
        var inputs = document.querySelectorAll('input[readonly], select[disabled]');
        var isEditMode = !inputs[0].hasAttribute('readonly');

        // Tampilkan notif-message ketika tombol edit diaktifkan
        var notifMessage = document.getElementById('notif-message');
        notifMessage.style.display = isEditMode ? 'none' : 'block';

        // Mengaktifkan atau menonaktifkan readonly dan disabled pada input dan select
        inputs.forEach(input => {
            if (isEditMode) {
                if (input.tagName === 'SELECT') {
                    input.setAttribute('disabled', true); // Nonaktifkan select
                } else {
                    input.setAttribute('readonly', true); // Nonaktifkan input
                }
                input.value = input.getAttribute('data-original'); // Kembalikan ke nilai asli
            } else {
                if (input.tagName === 'SELECT') {
                    input.removeAttribute('disabled'); // Aktifkan select
                } else {
                    input.removeAttribute('readonly'); // Aktifkan input
                }
                input.setAttribute('data-original', input.value); // Simpan nilai asli
            }

            // Set warna border menjadi hitam saat aktif
            if (!input.hasAttribute('readonly') && !input.hasAttribute('disabled')) {
                input.style.borderColor = 'black';
            }
        });

        // Aktifkan atau nonaktifkan tombol simpan
        document.getElementById('save-button').disabled = isEditMode;
    }




    // Function to close the message component
    function closeMessage(elementId) {
        const messageElement = document.getElementById(elementId);
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }

    // Hilangkan pesan secara otomatis setelah 5 detik
    window.onload = function() {
        const messageElement = document.getElementById('successMessage');
        if (messageElement) {
            setTimeout(() => {
                closeMessage('successMessage');
            }, 2000); // 5000 ms = 5 detik
        }
    };
</script>
