<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/final.css" />
</head>
<body>
    <div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-80">
            <div class="my-2 text-center items-center">
                <h4 class="text-3xl text-gray-800 font-bold">Selamat Datang di </h4>
                <span><img class="size-4" src="./img/logo1.png" alt="bertani"></span>
            </div>     
            <form class="space-y-4" action="{{ route('login.proses')}}" method="post">
                @csrf
                <div class="relative flex items-center">
                    <input type="email" placeholder="Email" name="email_address"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>

                <div class="relative flex items-center">
                    <input type="password" placeholder="Password" name="password"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>

                <button type="submit"
                        class="mb-4 px-5 py-2.5 w-full bg-black text-white text-sm rounded-lg tracking-wide">LOGIN
                </button>

                <div class="relative flex justify-center">
                    <p>Belum punya akun? <label> <a href="{{ route('register.tampil')}}" style="color: deepskyblue;">Sign Up</a></label></p>
                </div>

            </form>
            @if(session('gagal'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error</strong>
                <span class="block sm:inline">{{session('gagal')}}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
              </div>
            {{-- <p class="text-danger">{{session('gagal')}}</p> --}}
            @endif
        </div>
    </div>
</body>
</html>