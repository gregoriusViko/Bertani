<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/dropdown.js'])
    {{-- <link rel="preload" as="style" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-CyBUqrvq.css" /><link rel="modulepreload" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js" /><link rel="stylesheet" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-CyBUqrvq.css" /><script type="module" src="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js"></script>     --}}
    
    {{-- <link rel="stylesheet" href="https://rsms.me/inter/inter.css"> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>LaporanPenjualan-Bertani.com</title>
</head>
<body class="font-[Poppins] bg-white h-full">
    <header class="bg-green-600">
        {{-- <x-navbarpetani></x-navbarpetani> --}}
        <!-- <x-navbarpembeli></x-navbarpembeli> -->
        {{-- <x-navbaradmin></x-navbaradmin> --}}
        {{-- <x-navbardefault></x-navbardefault> --}}
        <x-navbarpetani></x-navbarpetani>
    </header>

    <script>
        const navLinks = document.querySelector('.nav-links')
        function onToggleMenu(e){
            e.name = e.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[9%]')
        }
    </script>

    <main px-7>
        <h1>ini laporan penjualan</h1>
        
        

    </main>
</body>
</html>