<div id="notification" class="relative m-2 my-8 max-w-sm rounded-lg border border-gray-100 bg-white px-12 py-4 shadow-md">
    {{-- <button class="absolute top-0 right-0 p-4 text-gray-400" onclick="hideNotification()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button> --}}
    <p class="relative mb-1 text-sm font-medium">
        <span class="absolute -left-7 flex h-5 w-5 items-center justify-center rounded-xl bg-green-400 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>
        <span class="text-gray-700 font-hind font-bold">{{ $message }}</span>
    </p>
    <p class="text-sm text-gray-600">
        {{ $slot }}
    </p>
</div>