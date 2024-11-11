<div>
    <div class="mx-10">
        <nav class="flex justify-between items-center">
            {{-- <div class="overflow-hidden sm:w-20 sm:h-14 md:w-36 md:h-20 lg:w-40 lg:h-20 flex items-center justify-center"> --}}
            <div>
                {{-- <img class="max-w-full max-h-full object-cover" src="/img/logo1.png" alt="Your Company"> --}}
                <img class="w-26 h-20" src="/img/logo1.png" alt="Your Company">
            </div>
            <div
                class="nav-links transition ease-in duration-200 md:static absolute bg-green-600 md:min-h-fit left-0 top-[-100%] md:w-auto  w-full flex items-center px-5 py-4">
                <ul
                    class="relative font-hind flex flex-col md:flex-row md:items-center md:gap-[2vw] md:text-base text-lg">
                    {{ $slot }}
                </ul>
            </div>
            <div class="flex items-center gap-6">
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
                        class="bg-green-600 text-white px-4 py-1 relative font-hind text-1xl font-semibold rounded-full hover:bg-white hover:text-green-600 flex items-center justify-center space-x-2"
                        type="button">
                        <span class="group-hover:text-green-600 relative font-hind text-1xl text-base font-semibold">
                            {{ $user ? $user->email_address : 'Belum Login' }}
                        </span>
                        @if ($user && $user->profile_img_link)
                            <img src="{{ $user->profile_img_link }}" alt=""
                                class="w-10 h-10 rounded-full object-cover group-hover:text-green-600">
                        @else
                            <ion-icon name="person-circle-outline"
                                class="text-2xl group-hover:text-green-600"></ion-icon>
                        @endif
                    </button>
                </a>
                <ion-icon onclick="onToggleMenu(this)" name="menu"
                    class="text-1xl cursor-pointer md:hidden text-white"></ion-icon>
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
