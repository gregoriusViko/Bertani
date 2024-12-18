<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN - Bertani.com</title>
    <link rel="icon" href="img/logokecil.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        /* Tambahkan efek blur pada background */
        .backdrop-blur {
            backdrop-filter: blur(90px);
            -webkit-backdrop-filter: blur(50px);
        }
    </style>
</head>

<body class="backdrop-blur-md bg-white/30 min-h-screen flex flex-wrap items-center justify-center bg-cover bg-center "
    style="background-image: url('img/bglogin.jpg');">
    <div class=" max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-90 w-11/12 md:w-10/12 lg:w-w-full">
        <div class="my-2 text-center items-center">
            <h4 class="text-3xl text-black font-bold">Selamat Datang di </h4>
            <span><img class="w-auto h-auto" src="./img/logo1.png" alt="bertani"></span>
        </div>
        @if (session('gagal'))
            {{-- !-- Alert Error --> --}}
            <div class="error-message relative flex w-full text-white bg-red-600 rounded-md justify-start p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="h-5 w-5 mr-2 pt-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z">
                    </path>
                </svg>{{ session('gagal') }}
            </div>

            <!-- End Alert Error -->
        @endif
        <form class="space-y-4" action="{{ route('login.proses') }}" method="post">
            @csrf
            <div class="relative flex items-center">
                <input type="email" placeholder="Email" name="email"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg"
                    required />
            </div>

            <div class="relative flex items-center">
                <input type="password" placeholder="Password" name="password" id="password"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg"
                    required />
                <button type="button" id="togglePassword" class="absolute right-4 bg-transparent focus:outline-none">
                    <img id="eye" src="./img/eyeclosed.png" alt="Toggle Password" class="w-5 h-5">
                </button>
            </div>
            <div class="relative flex justify-end hover:underline">
                <label> <a href="{{ route('LupaPassword') }}" style="color: blue;hover:text-white" id="lupapwd"
                        class="font-normal hover:text-white">Lupa Password</a></label>
            </div>

            <button id="submitLogin" type="submit"
                class="mb-4 px-5 py-2.5 w-full bg-black hover:scale-105 transition-transform duration-300 ease-in-out text-white text-sm rounded-lg">LOGIN
            </button>

            <div class="relative flex justify-center">
                <p>Belum punya akun? <label><a href="{{ route('register.tampil') }}" style="color: blue;hover:white"
                            id="regisnow">
                            <span class="hover:underline hover:text-white font-semibold">Daftar Sekarang</span></label>
                </p>
            </div>

        </form>
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#password");
        const eye = document.querySelector("#eye");

        togglePassword.addEventListener("click", () => {
            // Toggle tipe attribute
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Mengganti ikon eye 
            eye.src = type === "password" ? "./img/eyeclosed.png" : "./img/eyeopen.png";
        });
    </script>
</body>

</html>
