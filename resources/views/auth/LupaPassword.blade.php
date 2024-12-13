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

<body class="backdrop-blur-sm bg-white/40 min-h-screen flex flex-wrap items-center justify-center bg-cover bg-center "
    style="background-image: url('img/bglogin.jpg');">
    <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-90">

        <p class="text-black text-3xl font-bold pb-4 text-center">Lupa Password</p>
        <hr>

        <form class="max-w-md mt-4 space-y-4 lg:mt-5 md:space-y-5" action="{{ route('password.email') }}" method="post">
            @csrf
            <label for="password" class="block mb-2 text-2xl font-semibold text-black">Masukkan Email</label>
            <div class="relative flex items-center">
                <input type="email" placeholder="Masukkan Email" name="email" id="email"
                    class="px-4 py-2 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
            </div>

            <div class="flex justify-between">
                <button type="submit"
                    class="mb-4 px-5 py-2.5 w-48 bg-black text-white text-sm rounded-lg tracking-wide mx-auto hover:scale-105 transition-transform duration-300 ease-in-out">Kirim ke Email
                </button>
            </div>
        </form>
    </div>

    
</body>

</html>
