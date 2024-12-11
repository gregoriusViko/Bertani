<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN - Bertani.com</title>
    <link rel="icon" href="img/logokecil.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dropdown.js', 'resources/js/carousel.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    <div class=" max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-80 w-11/12 md:w-10/12 lg:w-w-full">
        <div class="my-2 text-center items-center">
            <h4 class="text-3xl text-black font-bold">Selamat Datang di </h4>
            <span><img class="w-auto h-auto" src="./img/logo1.png" alt="bertani"></span>
        </div>
        @if (session('gagal'))
            {{-- !-- Alert Error --> --}}
            <div class="error-message">
                <svg viewBox="0 0 24 24" class="error-icon">
                    <path fill="currentColor"
                        d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                    </path>
                </svg>
                <span class="error-text">{{ session('gagal') }}</span>
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
                <label> <a href="{{ route('LupaPassword') }}" style="color: blue;hover:text-white"
                        class="font-normal hover:text-white">Lupa Password</a></label>
            </div>

            <button type="submit"
                class="mb-4 px-5 py-2.5 w-full bg-black hover:scale-105 transition-transform duration-300 ease-in-out text-white text-sm rounded-lg">LOGIN
            </button>

            <div class="relative flex justify-center">
                <p>Belum punya akun? <label><a href="{{ route('register.tampil') }}" style="color: blue;hover:white">
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
