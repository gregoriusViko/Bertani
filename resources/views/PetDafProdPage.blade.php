<!DOCTYPE html>
<html lang="en">

<head>
    <!DOCTYPE html>
    <html lang="en" class="h-full bg-gray-100">

    <head>
        <html lang="en" class="h-full bg-gray-100" <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dropdown.js'])
        <link rel="preload" as="style"
            href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-DMNPLVqA.css" />
        <link rel="modulepreload" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js" />
        <link rel="stylesheet" href="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-DMNPLVqA.css" />
        <script type="module" src="https://4wmc4bxr-8000.asse.devtunnels.ms/build/assets/app-5jqjzOR5.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap"rel="stylesheet">
        <title>Daftar Produk-Bertani.com</title>
    </head>

<body class="font-[Poppins] bg-white h-full">
    <header class="bg-green-600">
        <x-navbar_petani></x-navbar_petani>
    </header>

    <script>
        const navLinks = document.querySelector('.nav-links')

        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[9%]')
        }
    </script>

    <main px-7 class="font-[Poppins]">
        {{-- <h1>ini daftar produk</h1> --}}
        <div dir="ltr">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Daftar Produk</h1>

                <div dir="rtl">
                    <button
                        class="items-center justify-center text-white bg-green-300 px-4 py-1 rounded-lg hover:bg-green-600"
                        type="button" id="addProduct-button" onclick="toggleAllInputs()">
                        <span><ion-icon name="add-circle-outline" class="ml-2 text"></ion-icon></span>
                        Tambah Produk
                    </button>
                </div>
            </div>
        </div>

        <!-- bawah ini adalah component untuk produk -->
        <div id="cardContainer"
            class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
            {{-- @foreach ($products as $product) --}}

            <div class="grid grid-cols-5 grid-rows-4 gap-4 border rounded-lg p-4">
                <div class="col-start-1 col-span-2 row-span-4 border rounded-lg">gambar </div>
                <div class="col-span-2">{{-- {{ $product->name --}}"Nama Produk"</div>
                <div class="col-end-6 ">{{-- {{ $product->price --}}"Rp xx.xxx"</div>
                <div class="col-span-2">{{-- {{ $product->product_type --}}Jenis Produk : </div>
                <div class="col-span-2">{{-- {{ $product->stock --}}Jumlah Stok :</div>
                <div class="col-end-6 ">
                    <button><ion-icon
                            name="create-outline" class="transition ease-in duration-300"></ion-icon></span></button>
                    <button><ion-icon
                            name="trash-outline" class="transition ease-in duration-300"></ion-icon></button>
                </div>
            </div>
            {{-- @endforeach --}}



        </div>



    </main>
</body>

</html>
