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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
    style="background-image: url('img/bglogin.jpg');">
    <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-90">

        <p class="text-black text-3xl font-bold pb-4 text-center">Lupa Password</p>
        <hr>

        <form class="max-w-md mt-4 space-y-4 lg:mt-5 md:space-y-5" action="{{ route('password.email') }}"
            method="post">
            @csrf
            <label for="password" class="block mb-2 text-2xl font-semibold text-black">Masukkan Email</label>
            <div class="relative flex items-center">
                <input type="email" placeholder="Masukkan Email" name="email" id="email" required
                    class="px-4 py-2 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
            </div>

            <div class="flex justify-between">
                <button type="submit" id="submit"
                    class="mb-4 px-5 py-2.5 w-48 bg-black text-white text-sm rounded-lg tracking-wide mx-auto hover:scale-105 transition-transform duration-300 ease-in-out">Kirim
                    ke Email
                </button>
            </div>
        </form>
    </div>

    @if (session('status'))
        <div id="successMessage"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
            <x-Message-success message="{{ session('status') }}">
                Buka Email Anda. Lakukan verifikasi untuk mengganti password.
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif

    <script>
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
    </script>


</body>

</html>
