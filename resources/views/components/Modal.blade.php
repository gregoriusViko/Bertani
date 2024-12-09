<div id="{{ $id }}" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg md:w-1/3" onclick="event.stopPropagation()">
        {{ $slot }}
    </div>
</div>