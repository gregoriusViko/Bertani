<x-layout>
    <x-slot:title>Admin-Delete Akun User-Bertani.com</x-slot:title>
    <div class="rounded-lg mt-8 px-7 mx-auto max-w-screen-lg">
        <form class="mb-4 max-lg:max-w-xl max-lg:mx-auto flex justify-center mt-4 gap-3"
            action="/admin/delete-akun/detail" method="get">
            <label for="cariAkun" class="text-xs md:text-base lg:text-lg text-black px-4 font-semibold">Cari Akun</label>
            <input type="text" id="cariAkun" name="email"
                class="pl-3 border border-black rounded-md w-1/2 block font-libre-franklin font-medium text-xs md:text-base text-black"
                required>
            <button id="buttonCari" type="submit"
                class="text-xs md:text-base lg:text-lg rounded-md bg-blue-500 text-white hover:bg-blue-700 px-3 ">OK</button>
        </form>

        @isset($user)
            <div class="rounded-md mt-8 px-7 mx-auto max-w-screen-lg bg-blue-400 py-4">
                <div class=" grid grid-flow-row gap-4  items-center place-items-center ">
                    <div class="items-center place-items-center">
                        <div class="avatar mb-3 w-20 h-20  ">
                            <img class="rounded-full object-cover w-20 h-20" src="/img/orang.jpeg.jpg" alt="avatar">

                        </div>
                        <h2 class="text-xs md:text-base font-libre-franklin font-bold text-black">{{ $user->email }}</h2>
                        <h4 class="font-libre-franklin font-normal text-sm text-gray-700">
                            {{ $role == 'farmer' ? 'Petani' : 'Pembeli' }}</h4>
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="nama-input"
                            class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">Nama
                            Pengguna</label>
                        <input type="text" id="nama-input" name="name"
                            class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            value="{{ $user->name }}" required readonly />
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="alamat-input"
                            class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">Alamat</label>
                        <input type="text" id="alamat-input" name="home_address"
                            class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            value="{{ $user->home_address }}" required readonly />
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="notelp-input"
                            class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">No
                            Telepon</label>
                        <input type="tel" id="notelp-input" name="phone_number"
                            class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $user->phone_number }}" required readonly />
                    </div>
                    <div id="button" class="my-3 flex place-items-end ">
                        <div class="flex items-end space-x-2 justify-between">
                            <a href="{{ route('DeleteAkun') }}">
                                <button onclick="showPopup('teruskan')" id="buttonBatal"
                                    class="rounded-md text-xs md:text-base bg-gray-400 hover:bg-gray-600 text-white px-2 py-1">BATALKAN</button>
                            </a>

                            <form action="{{ route('deleteAkun', ['role' => $role]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="showPopup('teruskan')" type="submit" name="id" id="buttonDelete"
                                    value="{{ $user->id }}"
                                    class="rounded-md text-xs md:text-base bg-gray-400 text-white hover:bg-red-600 px-2 py-1">HAPUS
                                    AKUN</button>
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        @endisset
        @if (session('success'))
            <div id="successMessage"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                <x-Message-success message="{{ session('success') }}">
                    Penghapusan akun berhasil
                    <button onclick="closeMessage('successMessage')"
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                        <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                    </button>
                </x-Message-success>
            </div>
        @endif
        @if (session('error'))
            <div id="errorMessage"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
                <x-Message-error message="{{ session('error') }}">
                    Akun tidak ditemukan.
                    <button onclick="closeMessage('error')"
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                        <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                    </button>
                </x-Message-error>
            </div>
        @endif
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <Script>
        function closeMessage(elementId) {
            const messageElement = document.getElementById(elementId);
            if (messageElement) {
                messageElement.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        window.onload = function() {
            const notification = document.getElementById('successMessage');
            if (notification) {
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000); // Notifikasi akan hilang setelah 5 detik
            }  // Hilangkan pesan error setelah 3 detik
            const errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    closeMessage('errorMessage');
                }, 3000); 
            }
        };
    </Script>
</x-layout>
