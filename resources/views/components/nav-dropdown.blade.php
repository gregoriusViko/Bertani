<li>
    <div x-data="{ isOpen: false }" @click.away = "isOpen = false" class="relative inline-block text-left">
        <div>
            <button type="button" @click="isOpen = !isOpen"
                class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-green-600 px-3 py-2 text-base font-semibold text-white hover:bg-gray-700 hover:text-white"
                id="menu-button" aria-expanded="true" aria-haspopup="true">
                {{ $title }}
                <svg
                :class="{'rotate-180': isOpen}"
                class="-mr-1 h-5 w-5 text-gray-300 hover:text-white transform transition-transform duration-200" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd"
                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div x-show="isOpen" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute left-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                {{ $slot }}
            </div>
        </div>
    </div>
</li>