<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Bertani.com</title>
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

<body class="backdrop-blur bg-white/30 min-h-screen flex flex-wrap items-center justify-center bg-cover bg-center "
    style="background-image: url('img/bglogin.jpg');">
    <div class="w-11/12 md:w-10/12 lg:w-w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-90">
        <div class="mb-7 text-center">
            <h4 class="text-3xl text-gray-800 font-inter font-bold">Buat Akun</h4>
            <!-- <img class="w-5 h-5" src="./img/logo2.png" alt="bertani"> -->
        </div>

        <form class="space-y-4" action="{{ route('register.submit') }}" method="post">
            @csrf
            <div class="relative flex items-center">
                <input type="text" placeholder="Nama" name="name"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg"
                    required />
            </div>

            <div class="relative flex items-center">
                <input type="email" placeholder="Email" name="email"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg"
                    required />
            </div>

            <div class="relative flex w-full">
                <!-- Button untuk membuka dropdown dan menampilkan opsi yang terpilih -->
                <button type="button" id="peran" onclick="toggleDropdown()"
                    class="px-4 py-3 border bg-white text-gray-400 text-sm font-inter font-normal border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 justify-start w-[450px]">
                    <div class="flex items-end w-full justify-between">
                        <p id="selectedOption">Peran</p>
                        <!-- Element ini akan diupdate dengan teks opsi terpilih -->
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500 inline ml-3"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                    clip-rule="evenodd" data-original="#000000" />
                            </svg>
                        </div>
                    </div>
                </button>

                <!-- Dropdown menu -->
                <ul id="dropdownMenu"
                    class="absolute hidden shadow-[0_8px_19px_-7px_rgba(6,81,237,0.2)] bg-white py-2 z-[1000] w-full divide-y max-h-96 overflow-auto rounded-lg mt-8">
                    <li onclick="selectOption('Pembeli')"
                        class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                        Pembeli</li>
                    <li onclick="selectOption('Petani')"
                        class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                        Petani</li>
                </ul>
            </div>

            <!-- tambahan untuk bank dan no. rekening untuk petani -->
            <div id="additionalFields" class="hidden space-y-4 mt-4">
                <div class="relative flex w-full mb-4">
                    <!-- Dropdown untuk memilih bank -->
                    <button type="button" id="bankDropdown" onclick="toggleDropdownBank()"
                        class="px-4 py-3 border bg-white text-gray-800 text-sm font-inter font-normal border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 w-full flex justify-between items-center">
                        <span id="selectedBank">Pilih Bank</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500 inline ml-3"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                clip-rule="evenodd" data-original="#000000" />
                        </svg>
                    </button>
                    <ul id="pilihBank"
                        class="absolute hidden shadow-[0_8px_19px_-7px_rgba(6,81,237,0.2)] bg-white py-2 z-[1000] w-full divide-y max-h-96 overflow-auto rounded-lg mt-2">
                        <li onclick="selectBank('BRI', 15)"
                            class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                            BRI</li>
                        <li onclick="selectBank('BNI', 10)"
                            class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                            BNI</li>
                        <li onclick="selectBank('MANDIRI', 13)"
                            class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                            MANDIRI</li>
                        <li onclick="selectBank('BCA', 10)"
                            class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">
                            BCA</li>
                    </ul>
                </div>

                <div class="relative flex items-center">
                    <input type="text" placeholder="Nomor Rekening" name="nomor_rekening" id="nomor_rekening"
                        class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>
            </div>

            <!-- input tersembunyi -->
            <input type="hidden" id="peranValue" name="peran" required />
            <input type="hidden" id="bankValue" name="bank" required />

            <div class="relative flex items-center">
                <input type="tel" placeholder="08xxxxxxxxx" pattern="^08[0-9]{8,10}$" name="telepon"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg"
                    required />
            </div>

            <div class="relative flex items-center">
                <input type="password" placeholder="Password" name="password" id="password"
                    class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg"
                    required minlength="6" />
                <button type="button" id="togglePassword"
                    class="absolute right-4 bg-transparent focus:outline-none">
                    <img id="eye" src="./img/eyeclosed.png" alt="Toggle Password" class="w-5 h-5">
                </button>
            </div>

            <button type="submit"
                class="px-5 py-2.5 w-full bg-black  text-white text-sm font-inter font-medium rounded-lg tracking-wide hover:scale-105 transition-transform duration-300 ease-in-out">Register
            </button>

            <p>Sudah punya akun? <a href="{{ route('login') }}" style="color: blue; hover:white">
                    <span class="hover:underline hover:text-white">Login disini</span>
                </a>
            </p>


        </form>

    </div>

    <script>
        // document.getElementById('peran').addEventListener('click', function() {
        //     var dropdownMenu = document.getElementById('dropdownMenu');
        //     dropdownMenu.classList.toggle('hidden');
        // });

        // document.querySelectorAll('#dropdownMenu li').forEach(function(item) {
        //     item.addEventListener('click', function() {
        //         document.getElementById('roleText').textContent = this.textContent;
        //         document.getElementById('dropdownMenu').classList.add('hidden');
        //     });
        // });

        // Fungsi untuk toggle dropdown menu
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#password");
        const eye = document.querySelector("#eye");

        togglePassword.addEventListener("click", () => {
            // Toggle tipe attribute
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Mengganti ikon eye 
            eye.src = type === "password" ? "./img/eyeclosed.png" : "./img/eyeopen.png";
        })

        function toggleDropdown() {
            const dropdownMenu = document.getElementById("dropdownMenu");
            dropdownMenu.classList.toggle("hidden");
        }

        // Fungsi untuk memilih opsi dan menutup dropdown
        function selectOption(option) {
            const selectedOptionElement = document.getElementById("selectedOption");
            selectedOptionElement.innerText = option;
            selectedOptionElement.classList.add("text-gray-800");

            document.getElementById("selectedOption").innerText = option; // Tampilkan teks opsi terpilih di button
            document.getElementById("peranValue").value = option;
            toggleDropdown(); // Tutup dropdown setelah memilih opsi

            if (option === "Petani") {
                additionalFields.classList.remove("hidden");
                additionalFields.classList.add("block");
            } else {
                additionalFields.classList.add("hidden");
                additionalFields.classList.remove("block");
            }
        }

        const nomorRekening = document.getElementById('nomor_rekening');
        nomorRekening.addEventListener('input', function() {
            // Menghapus karakter non-angka secara otomatis
            this.value = this.value.replace(/\D/g, '');
        })

        // Penyesuaian untuk nomor rekening sesuai ketentuan bank
        let maxDigits = 15; // Default batas digit

        // Fungsi untuk membuka/tutup dropdown
        function toggleDropdownBank() {
            const dropdownMenu = document.getElementById('pilihBank');
            dropdownMenu.classList.toggle('hidden');
        }

        // Fungsi untuk memilih bank
        function selectBank(bank, digits) {
            document.getElementById('selectedBank').textContent = bank; // Tampilkan nama bank
            document.getElementById('bankValue').value = bank; // Hapus isi nomor rekening
            maxDigits = digits; // Set batas digit sesuai bank
            document.getElementById('nomor_rekening').setAttribute('maxlength', digits); // Set batas input
            document.getElementById('nomor_rekening').value = ''; // Reset input nomor rekening
            toggleDropdownBank(); // Tutup dropdown
        }

        // Validasi input nomor rekening
        function validateAccountNumber() {
            const input = document.getElementById('nomor_rekening');
            const error = document.getElementById('rekeningError');

            if (input.value.length > maxDigits) {
                error.textContent = `Nomor rekening harus ${maxDigits} digit.`;
                error.classList.remove('hidden');
            } else if (input.value.length < maxDigits) {
                error.textContent = `Nomor rekening harus ${maxDigits} digit.`;
                error.classList.remove('hidden');
            } else {
                error.classList.add('hidden');
            }
        }

        // Tutup dropdown jika klik di luar area
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('bankDropdown');
            const menu = document.getElementById('pilihBank');
            if (!dropdown.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        })

        // Tutup dropdown jika klik di luar area dropdown atau button
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById("dropdownMenu");
            const button = document.getElementById("peran");

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    </script>
</body>

</html>
