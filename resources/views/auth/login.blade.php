<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/final.css" />
</head>

<body>
    <div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]"
        style="background-image: url('/img/bglogin.jpg');">
        <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-80">
            <div class="my-2 text-center items-center">
                <h4 class="text-3xl text-black font-bold">Selamat Datang di </h4>
                <span><img class="size-4" src="./img/logo1.png" alt="bertani"></span>
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
                        class="px-4 py-3 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>

                <div class="relative flex items-center">
                    <input type="password" placeholder="Password" name="password" id="password"
                        class="px-4 py-3 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                    <button type="button" id="togglePassword"
                        class="absolute right-4 bg-transparent focus:outline-none">
                        <img id="eye" src="./img/eyeclosed.png" alt="Toggle Password" class="w-5 h-5">
                    </button>
                </div>

                <button type="submit"
                    class="mb-4 px-5 py-2.5 w-full bg-black text-white text-sm rounded-lg tracking-wide">LOGIN
                </button>

                <div class="relative flex justify-center">
                    <p>Belum punya akun? <label> <a href="{{ route('register.tampil') }}"
                                style="color: blue;hover:text-white" class="font-bold hover:text-white">Sign
                                Up</a></label></p>
                </div>

            </form>
        </div>
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