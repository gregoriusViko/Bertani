@props(['active'=>false])
<li>
    <a {{ $attributes }}
        class="rounded-md {{ $active ? 'bg-gray-900' : 'bg-green-600' }} px-3 py-1 font-semibold text-white text-base hover:bg-gray-700 hover:text-white" onclick="{{ $active ? 'event.preventDefault();' : '' }}">
        {{ $slot }}
    </a>
</li>