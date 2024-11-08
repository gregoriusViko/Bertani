<x-layout>
    <x-slot:title>Profile-Bertani.com</x-slot:title>
    <!-- Kotak dengan konten -->
    <div class="bg-amber-100 text-white p-6 rounded-lg shadow-md max-w-xl items-center mx-auto mt-6">
        {{-- avatar --}}
        <div class="flex flex-col items-center">
            <div class="avatar mb-3 w-24 h-24">
                {{-- <div class="size-16 rounded-full border border-black"> --}}
                <img class="rounded-full object-cover w-24 h-24" src="{{ $user->profile_img_link ? $user->profile_img_link : './img/orang.jpeg.jpg' }}" alt="avatar">
                {{-- </div> --}}
            </div>
            <h2 class="text-base font-libre-franklin font-bold text-black">{{$user->email}}</h2>
            <h4 class="font-libre-franklin font-normal text-sm text-gray-700">{{$role}}</h4>
        </div>
        {{-- form --}}
        <form class="mt-6 max-w-sm mx-auto " id="profile-form" action="{{route('profile.update')}}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="nama-input" class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Nama Pengguna</label>
                <input type="text" id="nama-input" name="name"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{$user->name}}" required readonly />
            </div>
            <div class="mb-5">
                <label for="alamat-input" class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Alamat</label>
                <input type="text" id="alamat-input" name="home_address"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{$user->home_address}}" required readonly />
            </div>
            <div class="mb-5">
                <label for="notelp-input" class="block mb-1 text-base font-libre-franklin font-semibold  text-black">No Telepon</label>
                <input type="tel" id="notelp-input" name="phone_number"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{$user->phone_number}}" required readonly />
            </div>
            <div class="mb-5">
                <label for="email-input" class="block mb-1 text-base font-libre-franklin font-semibold  text-black">Email</label>
                <input type="text" id="email-input" name="email_address"
                    class="bg-gray-50 border mb-2 border-gray-300 text-black text-base font-libre-franklin font-normal items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{$user->email_address}}" required readonly />
            </div>
        </form>
        {{-- button group --}}
        <div class="flex items-center justify-between mt-4">
            <form action="{{route('profile.logout')}}" method="post">
                @csrf
                <button class="text-white bg-gray-600 px-4 py-1 rounded-lg hover:bg-gray-400 flex items-center justify-center space-x-2" type="submit">
                    <ion-icon name="log-out" class="text-2xl group-hover:text-green-600"></ion-icon>
                    <span class="group-hover:text-green-600">KELUAR</span>
                </button>
            </form>
            <div class="flex space-x-2">
                <button class="text-white bg-yellow-600 px-4 py-1 rounded-lg hover:bg-yellow-400 mr-2" type="button" id="edit-button" onclick="toggleAllInputs()">EDIT</button>
                <button class="text-white bg-blue-600 px-4 py-1 rounded-lg hover:bg-blue-400" type="submit" id="save-button" form="profile-form" disabled>SIMPAN</button>
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

    </div>
</x-layout>
{{-- toggleAllInputs() dan saveChanges() ada di \resources\js\app.js --}}
<script>
    function toggleAllInputs() {
        var inputs = document.querySelectorAll('input[readonly]');
        var isEditMode = !inputs[0].hasAttribute('readonly');
        // mengaktifkan tombol edit
        inputs.forEach(input => {
            if (isEditMode) {
                input.setAttribute('readonly', true);
                input.value = input.getAttribute('data-original');
            } else {
                input.removeAttribute('readonly');
                input.setAttribute('data-original', input.value);
            }
        })

        // aktif tombol simpan
        document.getElementById('save-button').disabled = isEditMode;
    }
</script>