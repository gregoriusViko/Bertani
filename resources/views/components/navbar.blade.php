<div>
    <div class="mx-7">
        <nav class="flex justify-between items-center">
            {{-- <div class="overflow-hidden sm:w-20 sm:h-14 md:w-36 md:h-20 lg:w-40 lg:h-20 flex items-center justify-center"> --}}
            <div>
                {{-- <img class="max-w-full max-h-full object-cover" src="/img/logo1.png" alt="Your Company"> --}}
                <img class="w-26 h-20" src="/img/logo1.png" alt="Your Company">
            </div>
            <div
                class="nav-links transition ease-in duration-200 absolute bg-green-600 md:min-h-fit left-0 top-[-100%] lg:static lg:top-0 lg:w-auto w-full flex items-center px-5 py-4">
                <ul class="relative font-hind flex flex-col lg:flex-row lg:items-center gap-[2vw] md:text-base text-lg">
                    {{ $slot }}
                </ul>
            </div>
            <div class="flex items-center md:gap-6 gap-1">
                @php
                    $user = null;
                    if (Auth::guard('admin')->check()) {
                        $user = Auth::guard('admin')->user();
                    } elseif (Auth::guard('buyer')->check()) {
                        $user = Auth::guard('buyer')->user();
                    } elseif (Auth::guard('farmer')->check()) {
                        $user = Auth::guard('farmer')->user();
                    }
                @endphp
                <a href="{{ $user ? route('profile') : '/login' }}">
                    <button
                        class="bg-white text-green-600 px-4 py-1 relative font-hind text-1xl font-semibold rounded-full hover:bg-green-300 hover:text-white hover:scale-105 transition-transform duration-200 ease-in-out flex items-center justify-center space-x-2"
                        type="button">
                        <span class="group-hover:text-green-600 relative font-hind text-1xl text-base font-semibold">
                            {{ $user ? $user->email : 'Login' }}
                        </span>
                        @if ($user && $user->profile_img_link)
                            <img src="{{ $user->profile_img_link }}" alt=""
                                class="w-6 h-6 md:w-8 md:h-8 rounded-full object-cover group-hover:text-green-600">
                        @elseif ($user)
                            <ion-icon name="person-circle-outline"
                                class="text-2xl group-hover:text-green-600"></ion-icon>
                        @endif
                    </button>
                </a>
                <ion-icon onclick="onToggleMenu(this)" name="menu"
                    class="text-1xl cursor-pointer text-white lg:hidden"></ion-icon>
            </div>
        </nav>
    </div>

    <script>
        function toggleDropdownMenu() {
            const dropdown = document.getElementById("lainnyaDropdownMenu");
            dropdown.classList.toggle("hidden");
        }

        const navLinks = document.querySelector('.nav-links')

        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu';
            navLinks.classList.toggle('top-[9%]');
            navLinks.style.zIndex = '99';
        }

         // Menambahkan event listener untuk klik di luar menu
         document.addEventListener('click', function(event) {
            const isClickInsideMenu = navLinks.contains(event.target) || event.target.closest('ion-icon');
            if (!isClickInsideMenu) {
                navLinks.classList.remove('top-[9%]'); // Menutup menu jika klik di luar
                const menuIcon = document.querySelector('ion-icon[name="close"]');
                if (menuIcon) {
                    menuIcon.name = 'menu'; // Mengubah ikon kembali ke menu
                }
            }
        });
    </script>
</div>
