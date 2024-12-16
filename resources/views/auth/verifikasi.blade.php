<x-layout>
    <x-slot:title>Verifikasi</x-slot:title>
    <div class="mt-10 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
            <p class="font-hind font-bold text-xl">Verifikasi Akun</p>
            <p class="font-hind text-base mb-8">Pengguna diwajibkan melakukan verifikasi yang dikirim melalui gmail anda.</p>
            <form action="/email/verification-notification" method="post">
                @csrf
                <button type="submit" class="font-hind hover:underline">Kirim ulang</button>
            </form>
            <h1 class="font-hind ">Ganti email</h1>
            <form action="{{ route('gantiEmail') }}" method="post">
              @csrf
                <input type="text" name="email" placeholder="Masukkan email baru anda" class="border mb-2 border-gray-300 text-black text-base font-hind font-normal items-center px-2 py-1 rounded-lg">
                <button type="submit" class="bg-black text-white hover:bg-green-700 rounded-lg text-base font-hind font-normal items-center mb-2 px-2 py-1">Kirim</button>
            </form>
          </div>
          
        </div>
      </div>
</x-layout>