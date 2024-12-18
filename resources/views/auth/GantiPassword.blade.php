<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Password - Bertani.com</title>
    <link rel="icon" href="img/logokecil.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

<body class="backdrop-blur-sm bg-white/40 min-h-screen flex flex-wrap items-center justify-center bg-cover bg-center "
    style="background-image: url('/img/bglogin.jpg');">
    <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-80">

        <p class="text-black text-3xl font-bold pb-4 text-center">Ganti Password</p>
        <hr>
        <form action="{{ route('password.update') }}" method="post"
            class="max-w-md mt-4 space-y-4 lg:mt-5 md:space-y-5">
            @csrf
            <label for="password" class="block mb-2 text-2xl font-semibold text-black">Ganti Password</label>
            <div class="relative flex flex-col items-start">
                <div class="relative flex items-center w-full">
                    <input type="password" placeholder="Masukkan password baru" name="password" id="password" required
                        class="px-4 py-2 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                    <button type="button" id="togglePassword"
                        class="absolute right-4 bg-transparent focus:outline-none">
                        <img id="eye" src="/img/eyeclosed.png" alt="Toggle Password" class="w-5 h-5">
                    </button>
                </div>
                <p class="flex items-start text-sm text-red-500 mt-2 hidden" id="passwordMessage">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 mr-1.5">
                        <path fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd" />
                    </svg>Gunakan password yang kuat dengan minimal jumlah karakter 6.
                </p>
            </div>

            <!-- <div class="py-4"></div> -->

            <label for="confirm_password" class="block mb-2 text-2xl font-semibold text-black">Konfirmasi
                Password</label>
            <div class="relative flex flex-col items-start">
                <div class="relative flex items-center w-full">
                    <input type="password" placeholder="Masukkan password kembali" name="password_confirmation"
                        id="confirm_password" required
                        class="px-4 py-2 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" id="toggleConfirmPassword"
                        class="absolute right-4 bg-transparent focus:outline-none">
                        <img id="confirm_eye" src="/img/eyeclosed.png" alt="Toggle Password" class="w-5 h-5">
                    </button>
                </div>
                <p class="flex items-start text-sm text-red-500 mt-2 hidden" id="passwordkonfirmMessage">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 mr-1.5">
                        <path fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd" />
                    </svg>Gunakan password yang kuat dengan minimal jumlah karakter 6.
                </p>
            </div>

            <div class="grid grid-flow-col justify-between">
                <div class="">
                    <a href=" {{ route('login') }}">
                        <button id="back" type="button"
                            class="px-5 py-2.5 w-48 bg-black text-white text-sm rounded-lg tracking-wide mx-auto">Kembali
                        </button></a>
                </div>
                <div class="">
                    <button id="simpan" type="submit"
                    class="px-5 py-2.5 w-48 bg-black text-white text-sm rounded-lg tracking-wide mx-auto">Simpan
                </button>
                </div>

                
            </div>
        </form>
    </div>
    @if (session('error'))
        <div id="errorMessage"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
            <x-Message-success message="{{ session('error') }}">
                Gagal memperbarui password.
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#password");
        const eye = document.querySelector("#eye");

        togglePassword.addEventListener("click", () => {
            // Toggle tipe attribute
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Mengganti ikon eye 
            eye.src = type === "password" ? "/img/eyeclosed.png" : "/img/eyeopen.png";
        });

        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
        const confirmPasswordField = document.querySelector("#confirm_password");
        const confirmEye = document.querySelector("#confirm_eye");

        toggleConfirmPassword.addEventListener("click", () => {
            // Toggle tipe attribute
            const type = confirmPasswordField.getAttribute("type") === "password" ? "text" : "password";
            confirmPasswordField.setAttribute("type", type);

            // Mengganti ikon eye 
            confirmEye.src = type === "password" ? "/img/eyeclosed.png" : "/img/eyeopen.png";
        });


        const passwordInput = document.getElementById('password');
        const confirm_password = document.getElementById('confirm_password');
        const passwordMessage = document.getElementById('passwordMessage');
        const passwordkonfirmMessage = document.getElementById('passwordkonfirmMessage');

        passwordInput.addEventListener('input', () => {
            if (passwordInput.value.length > 0 && passwordInput.value.length < 6) {
                passwordMessage.classList.remove('hidden');
            } else {
                passwordMessage.classList.add('hidden');
            }
        });
        confirm_password.addEventListener('input', () => {
            if (confirm_password.value.length > 0 && confirm_password.value.length < 6) {
                passwordkonfirmMessage.classList.remove('hidden');
            } else {
                passwordkonfirmMessage.classList.add('hidden');
            }
        });

        // Function to close the message component
        function closeMessage(elementId) {
            const messageElement = document.getElementById(elementId);
            if (messageElement) {
                messageElement.style.display = 'none';
                body.style.overflow = ''; // Aktifkan scroll
            }
        }

        // Hilangkan pesan secara otomatis setelah 5 detik
        window.onload = function() {
            const messageElement = document.getElementById('successMessage');
            if (messageElement) {
                // document.body.style.overflow = 'hidden';
                body.style.overflow = 'hidden'; // Kunci scroll
                setTimeout(() => {
                    closeMessage('successMessage');
                }, 3000); // 5000 ms = 5 detik
            }

            // Hilangkan pesan error setelah 5 detik
            const errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                body.style.overflow = 'hidden';
                setTimeout(() => {
                    closeMessage('errorMessage');
                }, 3000); // 5000 ms = 5 detik
            }
        };

        // pass
    </script>


</body>

</html>
