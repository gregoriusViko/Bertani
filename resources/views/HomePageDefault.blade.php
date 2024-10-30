<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="preload" as="style" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-CyBUqrvq.css" /><link rel="modulepreload" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js" /><link rel="stylesheet" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-CyBUqrvq.css" /><script type="module" src="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js"></script>     --}}
    {{-- <link rel="stylesheet" href="https://rsms.me/inter/inter.css"> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Home-Bertani.com</title>
</head>
<body class="font-[Poppins] bg-white h-full">
    <header class="bg-green-600">
        {{-- <x-navbarpetani></x-navbarpetani> --}}
        <!-- <x-navbarpembeli></x-navbarpembeli> -->
        {{-- <x-navbaradmin></x-navbaradmin> --}}
        <x-navbardefault></x-navbardefault> 
    </header>

    <script>
        const navLinks = document.querySelector('.nav-links')
        function onToggleMenu(e){
            e.name = e.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[9%]')
        }
    </script>

    <main px-7>
        <div class="jumbotron mt-6 bg-cover bg-centerflex items-center justify-center text-gray-800 gap-x-3 p-14 w-15 rounded-lg font-[sans-serif] max-w-4xl mx-auto" style="background-image: url('./img/bgjumbo.jpg');">
            <h1 class="text-4xl font-extrabold text-white text-center">BELI PRODUK HASIL TANI</h1>
            <p class="mt-4 text-base text-white text-center">Dukung petani lokal dan rasakan kelezatan hasil bumi Indonesia.</p>
      
            {{-- <button type="button"
              class="px-6 py-3 mt-8 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-blue-600 hover:bg-blue-700">Learn
              more</button> --}}
        </div>
        
        {{-- form searching --}}
        <form class="mt-4 px-5 max-w-md mx-auto" action="">
            <label for="searching" class="mb-2 text-sm font-regular text-white sr-only">Cari Produk</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-white">
                    <ion-icon name="search" class="text-white"></ion-icon>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 pl-10 text-sm text-white border border-gray-300 rounded-lg bg-green-600 placeholder-white focus:ring-green-500 focus:border-green-500"
                    placeholder="Cari Produk" required />
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-green-600 hover:bg-white hover:text-green-600 focus:ring-4 focus:ring-white font-medium rounded-lg text-sm px-4 py-2 ">
                    Search
                </button>
            </div>
        </form>

    </main>
</body>
</html>