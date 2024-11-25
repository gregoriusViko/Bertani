{{-- <a {{ $attributes }} class="block px-4 py-2 relative font-[hind] text-1xl text-black hover:bg-green-600 cursor-pointer"
    role="menuitem" tabindex="-1" id="menu-item-1">{{ $slot }}</a> --}}

    <a {{ $attributes }} class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-1x text-black {{ $active ? 'bg-green-600' : 'hover:bg-green-600' }} " href="#" onclick="{{ $active ? 'event.preventDefault();' : '' }}">
        {{ $slot }}
      </a>