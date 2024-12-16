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
                class="text-xs md:text-base lg:text-lg rounded-md bg-blue-500 text-white hover:bg-blue-700 px-3">OK</button>
        </form>

        @isset($user)
        <div class="rounded-md mt-8 px-7 mx-auto max-w-screen-lg bg-[#A0D683] py-4" id="kotakHasil">
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
                            class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold text-black">Nama
                            Pengguna</label>
                        <input type="text" id="nama-input" name="name"
                            class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $user->name }}" required readonly />
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="alamat-input"
                            class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold text-black">Alamat</label>
                        <input type="text" id="alamat-input" name="home_address"
                            class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $user->home_address }}" required readonly />
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="notelp-input"
                            class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold text-black">No
                            Telepon</label>
                        <input type="tel" id="notelp-input" name="phone_number"
                            class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $user->phone_number }}" required readonly />
                    </div>
                    @if ($role == 'farmer')
                        <div class="w-full md:w-1/2">
                            <label for="bank-input"
                                class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">Bank</label>
                            <input type="tel" id="notelp-input" name="phone_number"
                                class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $user->bank }}" required readonly />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label for="norek-input"
                                class="block mb-1 text-xs md:text-base font-libre-franklin font-semibold  text-black">Nomor
                                Rekening</label>
                            <input type="tel" id="notelp-input" name="phone_number"
                                class="bg-gray-50 border mb-2 border-gray-300 text-black text-xs md:text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $user->nomor_rekening }}" required readonly />
                        </div>
                    @endif
                    <div id="button" class="my-3 flex place-items-end">
                        <div class="flex items-end space-x-2 justify-between">
                            <a href="{{ route('DeleteAkun') }}">
                                <button id="buttonBatal"
                                    class="rounded-md text-xs md:text-base bg-gray-400 hover:bg-gray-600 text-white px-2 py-1">BATALKAN</button>
                            </a>

                            <button type="button" onclick="showDeletePopup()" id="buttonDelete"
                                class="rounded-md text-xs md:text-base bg-gray-400 text-white hover:bg-red-600 px-2 py-1">HAPUS
                                AKUN</button>
                        </div>
                    </div>
                </div>

                <!-- Modal Popup -->
                <div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Alasan Penghapusan</h2>
                        <form action="{{ route('deleteAkun', ['role' => $role]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <textarea name="reason" id="reason" rows="4" placeholder="Tuliskan alasan penghapusan akun..."
                                class="w-full border border-gray-300 rounded-lg p-2 text-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                required></textarea>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="flex justify-end space-x-2 mt-4">
                                <button type="button" onclick="closeDeletePopup()"
                                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-600">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of Modal Popup -->
            </div>
        @endisset
    </div>

    <script>
        function showDeletePopup() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeletePopup() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = '';
        }
    </script>
</x-layout>
