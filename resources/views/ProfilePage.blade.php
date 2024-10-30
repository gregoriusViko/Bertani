<!DOCTYPE html>
<html lang="en">

<head>
    <html lang="en" class="h-full bg-gray-100" <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js' ,'resources/js/dropdown.js'])
    <link rel="preload" as="style" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-DMNPLVqA.css" />
    <link rel="modulepreload" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js" />
    <link rel="stylesheet" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-DMNPLVqA.css" />
    <script type="module" src="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap"rel="stylesheet">
    <title>Profile-Bertani.com</title>
</head>

<body class="font-[Poppins] bg-white">
    <header class="bg-green-600">

        <x-navbar_pembeli></x-navbar_pembeli>
    </header>

    <script>
        const navLinks = document.querySelector('.nav-links')

        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[9%]')
        }
    </script>

    <main class="px-5 flex-grow">
        <!-- Kotak dengan konten -->
        <div class="bg-amber-100 text-white p-6 rounded-lg shadow-md max-w-xl items-center mx-auto mt-6">
            {{-- avatar --}}
            <div class="flex flex-col items-center">
                <div class="avatar mb-3">
                    <div class="size-10 rounded-full border border-black">
                    <img class="size-10 rounded-full" src="./img/orang.jpeg.jpg" alt="avatar">
                    </div>
                </div>
                <h2 class="text-base font-bold text-black">Nama Pengguna</h2>
                <h4 class="text-sm text-gray-700">Deskripsi pengguna atau informasi tambahan.</h4>
            </div>
            {{-- form --}}
            <form class="mt-6 max-w-sm mx-auto ">
                <div class="mb-5">
                    <label for="nama-input" class="block mb-1 text-base font-semibold text-black">Nama Pengguna</label>
                    <input type="text" id="nama-input"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="name@flowbite.com" required readonly />
                </div>
                <div class="mb-5">
                    <label for="alamat-input" class="block mb-1 text-base font-semibold  text-black">Alamat</label>
                    <input type="text" id="alamat-input"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="Jalan ABC No. 123"required readonly />
                </div>
                <div class="mb-5">
                    <label for="notelp-input" class="block mb-1 text-base font-semibold  text-black">No Telepon</label>
                    <input type="tel" id="notelp-input"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="08123456789" required readonly />
                </div>
                <div class="mb-5">
                    <label for="email-input" class="block mb-1 text-base font-semibold  text-black">Email</label>
                    <input type="text" id="email-input"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="name@flowbite.com" required readonly />
                </div>
                <div class="mb-5">
                    <label for="password-input" class="block mb-1 text-base font-semibold text-black">Password</label>
                    <input type="password" id="password-input"
                        class="bg-gray-50 border mb-2 border-gray-300 text-black text-base items-center pl-3 py-1 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required readonly />
                </div>
            </form>
            {{-- button group --}}
            <div class="flex items-center justify-between mt-4">
                {{-- button logout --}}
                <button
                    class="bg-gray-500 text-white bg-gray-600 px-4 py-1 rounded-lg hover:bg-gray-400 flex items-center justify-center space-x-2"
                    type="button">
                    <!-- <span class="group-hover:text-green-600">KELUAR</span> -->
                    <ion-icon name="log-out" class="text-2xl group-hover:text-green-600"></ion-icon>
                    <span class="group-hover:text-green-600">KELUAR</span>
                </button>
                <div class="flex space-x-2">
                    {{-- button edit --}}
                <button class="text-white bg-yellow-600 px-4 py-1 rounded-lg hover:bg-yellow-400 mr-2" type="button"
                    id="edit-button" onclick="toggleAllInputs()">EDIT</button>

                {{-- button simpan --}}
                <button class="text-white bg-blue-600 px-4 py-1 rounded-lg hover:bg-blue-400" type="button"
                    id="save-button" onclick="saveChanges()" disabled>SIMPAN</button>
                </div>
            </div>
            <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
        </div>
    </main>
</body>

</html>
