<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/final.css" />
</head>

<body>
    <div
        class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full bg-no-repeat bg-cover bg-center z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]" 
        style="background-image: url('https://www.infosawit.com/wp-content/uploads/2023/07/lanskap-sawi_Miftahurrohman.jpg');">
        <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-80">
            <div class="my-7 text-center">
                <h4 class="text-3xl text-gray-800 font-inter font-bold">Buat Akun</h4>
                <!-- <img class="w-5 h-5" src="./img/logo2.png" alt="bertani"> -->
            </div>

            <form class="space-y-4" action="{{ route('register.submit') }}" method="post">
                @csrf        
                <div class="relative flex items-center">
                    <input type="text" placeholder="Nama" name="name"
                        class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>
                
                <div class="relative flex items-center">
                    <input type="email" placeholder="Email" name="email"
                        class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>

                <div class="relative flex w-full">
                    <!-- Button untuk membuka dropdown dan menampilkan opsi yang terpilih -->
                    <button type="button" id="peran" onclick="toggleDropdown()"
                        class="px-4 py-3 border bg-white text-gray-400 text-sm font-inter font-normal border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 justify-start w-[450px]">
                        <div class="flex items-end w-full justify-between">
                            <p id="selectedOption">Peran</p> <!-- Element ini akan diupdate dengan teks opsi terpilih -->
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500 inline ml-3" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                        clip-rule="evenodd" data-original="#000000" />
                                </svg>
                            </div>
                        </div>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <ul id="dropdownMenu"
                        class="absolute hidden shadow-[0_8px_19px_-7px_rgba(6,81,237,0.2)] bg-white py-2 z-[1000] w-full divide-y max-h-96 overflow-auto rounded-lg mt-8" >
                        <li onclick="selectOption('Pembeli')"
                            class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">Pembeli</li>
                        <li onclick="selectOption('Petani')"
                            class="py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm font-inter font-normal cursor-pointer">Petani</li>
                    </ul>
                </div>

                <!-- input tersembunyi -->
                <input type="hidden" id="peranValue" name="peran" />

                <div class="relative flex items-center">
                    <input type="tel" placeholder="08xxxxxxxxx" pattern="08[0-9]{9}" name="telepon"
                        class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>

                <div class="relative flex items-center">
                    <input type="password" placeholder="Password" name="password"
                        class="px-4 py-3 bg-white text-gray-800 w-full text-sm font-inter font-normal border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                </div>

                <button type="submit"
                    class="px-5 py-2.5 w-full bg-black text-white text-sm font-inter font-medium rounded-lg tracking-wide hover:bg-green-500">Register
                </button>

            </form>

        </div>
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
    }

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
