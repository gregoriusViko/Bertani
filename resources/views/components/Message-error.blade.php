<!-- Warn -->
<div class="relative m-2 my-8 max-w-sm rounded-lg border border-gray-100 bg-white px-12 py-4 shadow-md">
    {{-- <button class="absolute top-0 right-0 p-4 text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="h-5 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button> --}}
    <p class="relative mb-1 text-sm font-medium">
        <span class="absolute -left-7 flex h-5 w-5 items-center justify-center rounded-xl bg-yellow-400 text-white"> !
        </span>
        <span class="text-gray-700 font-hind font-bold">{{ $message }}</span>
    </p>
    <p class="text-sm text-gray-600">{{ $slot }}</p>
</div>
<!-- /Warn -->
