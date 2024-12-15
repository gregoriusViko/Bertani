<x-layout>
    <style>
        button:disabled {
            background-color: #9ca3af;
            /* Warna abu-abu */
            cursor: not-allowed;
            /* Mengubah kursor menjadi tanda larangan */
            opacity: 0.6;
            /* Menambahkan efek transparan */
        }
    </style>

    <x-slot:title>Profile-Bertani.com</x-slot:title>
    <!-- Kotak dengan konten -->
    <div class="bg-amber-100 text-white p-6 rounded-lg shadow-md max-w-xl items-center mx-auto mt-6">
        {{-- avatar --}}
        <div class="flex flex-col items-center relative">
            <div class="avatar mb-3 w-24 h-24 relative">
                {{-- <div class="size-16 rounded-full border border-black"> --}}
                <img id="avatar" class="rounded-full object-cover w-24 h-24"
                    src="{{ $user->profile_img_link ? $user->profile_img_link : './img/orang.jpeg.jpg' }}" alt="avatar">
                {{-- </div> --}}
                <button id="editGbr"
                    class="hidden absolute bottom-1 right-1 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                    title="Edit Gambar">
                    <ion-icon name="pencil-outline"></ion-icon>
                </button>
                <!-- Tombol Hapus -->
                <button id="hapusGbr"
                    class="hidden absolute bottom-1 left-1 bg-red-500 text-white rounded-md hover:bg-red-600"
                    title="Hapus Gambar">
                    <ion-icon name="trash-outline"></ion-icon>
                </button>


                <!-- Input File (Tersembunyi) -->
                <input id="fileInput" type="file" accept="image/*" class="hidden">
            </div>
            <h2 id="emailnya" class="text-base font-libre-franklin font-bold text-black">{{ $user->email }}</h2>
            <h4 id="perannya" class="font-libre-franklin font-normal text-sm text-gray-700">{{ $role }}</h4>

        </div>

        <div id="notif-message" class="notif-message hidden">
            <x-Message-info>Silahkan perbarui data anda</x-Message-info>
        </div>

        {{-- form --}}
        <form class="mt-6 max-w-sm mx-auto " id="profile-form" action="{{ route('profile.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <input id="fileInputAvatar" type="file" accept="image/*" name="profile_img" class="hidden">
                <input id="hapusProfil" name="delete_image" type="text" value="0" hidden>
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
                        class="block mb-1 text-base font-libre-franklin font-semibold text-black">Nomor Rekening</label>
                    <input type="text" id="rekening-input" name="nomor_rekening"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $user->nomor_rekening }}" required readonly pattern="\d{10,15}"
                        title="Nomor rekening harus terdiri dari 10 hingga 15 digit" />
                </div>
            @endif

        </form>
        {{-- button group --}}
        <div class="flex items-center justify-between mt-4">
            <form action="{{ route('profile.logout') }}" method="post">
                @csrf
                <button
                    class="text-white bg-gray-600 px-4 py-1 rounded-lg hover:bg-gray-400 flex items-center justify-center space-x-2"
                    id="logout" type="submit">
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
    // Global variable to track if profile image should be deleted
    let shouldDeleteProfileImage = false;

    function toggleAllInputs() {
        var inputs = document.querySelectorAll('input[readonly], select[disabled]');
        var isEditMode = !inputs[0].hasAttribute('readonly');

        // Tampilkan notif-message ketika tombol edit diaktifkan
        var notifMessage = document.getElementById('notif-message');
        notifMessage.style.display = isEditMode ? 'none' : 'block';
        var editProf = document.getElementById('editGbr');
        const fileInput = document.getElementById('fileInputAvatar');
        const avatar = document.getElementById('avatar');

        var hapusProf = document.getElementById('hapusGbr');

        editProf.style.display = isEditMode ? 'hidden' : 'block';
        // Ketika tombol edit diklik, buka input file
        editGbr.addEventListener('click', () => {
            fileInput.click();
        });

        // Ketika file dipilih, ganti gambar avatar
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                // Buat URL sementara untuk pratinjau gambar
                const imageUrl = URL.createObjectURL(file);
                avatar.src = imageUrl;

                console.log('File yang dipilih:', file.name);
                document.getElementById('hapusProfil').value = 0;
            }
        });

        // Tambahkan event listener untuk tombol hapus
        hapusProf.addEventListener('click', () => {
            const defaultImage = './img/orang.jpeg.jpg'; // Path ke gambar default

            // Set flag to delete profile image when save is clicked
            shouldDeleteProfileImage = true;

            // Temporarily change avatar to default image
            avatar.src = defaultImage;
            document.getElementById('hapusProfil').value = 1;
        });

        hapusProf.style.display = isEditMode ? 'hidden' : 'block';

        // Mengaktifkan atau menonaktifkan readonly dan disabled pada input dan select
        inputs.forEach(input => {
            if (isEditMode) {
                if (input.tagName === 'SELECT') {
                    input.setAttribute('disabled', true);
                } else {
                    input.setAttribute('readonly', true);
                }
                input.value = input.getAttribute('data-original');
            } else {
                if (input.tagName === 'SELECT') {
                    input.removeAttribute('disabled');
                } else {
                    input.removeAttribute('readonly');
                }
                input.setAttribute('data-original', input.value);
            }

            // Set warna border menjadi hitam saat aktif
            if (!input.hasAttribute('readonly') && !input.hasAttribute('disabled')) {
                input.style.borderColor = 'black';
            }
        });

        // Aktifkan atau nonaktifkan tombol simpan
        document.getElementById('save-button').disabled = isEditMode;
    }

    const saveButton = document.getElementById('save-button');
    const form = document.getElementById('profile-form');

    // Simulasi: Aktifkan tombol setelah form diisi (contoh sederhana)
    form.addEventListener('input', () => {
        const isFormValid = form.checkValidity(); // Cek validasi form
        saveButton.disabled = !isFormValid; // Aktifkan tombol jika valid
    });


    // Modify the form submission to handle profile image deletion
    document.getElementById('profile-form').addEventListener('submit', function(event) {
        if (shouldDeleteProfileImage) {
            // Submit the delete profile image form
            document.getElementById('delete-profile-image-form').submit();

            // Reset the flag
            shouldDeleteProfileImage = false;
        }
    });

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
            }, 2000);
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const bankInput = document.getElementById('bank-input');
        const rekeningInput = document.getElementById('rekening-input');

        // Atur panjang nomor rekening berdasarkan bank yang dipilih
        const bankMaxDigits = {
            BRI: 15,
            BNI: 10,
            Mandiri: 13,
            BCA: 10,
        };

        bankInput.addEventListener('change', function() {
            const selectedBank = bankInput.value;

            if (selectedBank in bankMaxDigits) {
                const maxLength = bankMaxDigits[selectedBank];
                rekeningInput.setAttribute('maxlength', maxLength);
                rekeningInput.setAttribute('pattern', `\\d{${maxLength}}`);
                rekeningInput.setAttribute(
                    'title',
                    `Nomor rekening untuk ${selectedBank} harus ${maxLength} digit.`
                );
            }
        });

        // Pastikan aturan diperbarui saat halaman dimuat
        if (bankInput.value) {
            bankInput.dispatchEvent(new Event('change'));
        }
    });
</script>
