<div>
    <div>
        <nav class="flex justify-between items-center w-[90%]  mx-auto">
            <div>
                <img class="w-26 h-20" src = "img/logo1.png" alt="Your Company">
            </div>
            <div
                class="nav-links duration-500 md:static absolute bg-green-600 md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5 py-4">
                <ul class="relative font-[hind] flex md:flex-row flex-col md:items-center md:gap-[2vw] gap-8">
                    {{ $slot }}
                </ul>
            </div>
            <div class="flex items-center gap-6">
                <button
                    class="bg-green-600 text-white px-4 py-1 relative font-[hind] text-1xl text-semibold rounded-full hover:bg-white hover:text-green-600 flex items-center justify-center space-x-2"
                    type="button">
                    <span class="group-hover:text-green-600 relative font-[hind] text-1xl text-base text-semibold">
                        @if (Auth::check())
                            {{ Auth::user()->email_address }}
                        @else
                            Belum login
                        @endif
                    </span>
                    <ion-icon name="person-circle-outline" class="text-2xl group-hover:text-green-600"></ion-icon>
                </button>
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-1xl cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
    </div>
    
    <script>
        function toggleDropdownMenu() {
            const dropdown = document.getElementById("lainnyaDropdownMenu");
            dropdown.classList.toggle("hidden");
        }
    </script>    
</div>