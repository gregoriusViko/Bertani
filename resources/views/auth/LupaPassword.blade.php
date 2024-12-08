<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="css/final.css" />
</head>

<body>
    <div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]"
        style="background-image: url('/img/bglogin.jpg');">

        <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-80">

            <p class="text-black text-3xl font-bold py-8 text-center">Lupa Password</p>

            <form class="max-w-md mt-4 space-y-4 lg:mt-5 md:space-y-5" action="{{ route('password.email') }}" method="post">
                @csrf
                <label for="password" class="block mb-2 text-2xl font-semibold text-black">Masukkan Email</label>
                <div class="relative flex items-center">
                    <input type="email" placeholder="Masukkan Email" name="email" id="email"
                        class="px-4 py-2 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>

                <div class="flex justify-between">
                    <button type="submit"
                        class="mb-4 px-5 py-2.5 w-48 bg-black text-white text-sm rounded-lg tracking-wide mx-auto">Kirim ke Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
