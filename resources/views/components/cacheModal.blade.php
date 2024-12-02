<div id="{{ $modalId ?? 'hs-scale-animation-modal' }}" 
     class="hs-overlay hidden fixed inset-0 z-[9999] overflow-x-hidden overflow-y-auto pointer-events-none" 
     role="dialog" tabindex="-1" aria-labelledby="{{ $modalId ?? 'hs-scale-animation-modal-label' }}">

    <div class="hs-overlay-animation-target scale-95 opacity-0 transition-all duration-200 sm:max-w-lg sm:w-full mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">

            <!-- Header Modal -->
            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                <h3 id="{{ $modalId ?? 'hs-scale-animation-modal-label' }}" class="font-bold text-gray-800 dark:text-white">
                    {{ $title ?? 'Modal Title' }}
                </h3>
                <button type="button" 
                        class="inline-flex justify-center items-center gap-x-2 rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400" 
                        aria-label="Close" 
                        onclick="toggleModal('{{ $modalId ?? 'hs-scale-animation-modal' }}')">
                    <span class="sr-only">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content Modal -->
            <div class="p-4 overflow-y-auto">
                {{ $slot }}
            </div>

            <!-- Footer Modal -->
            <div class="flex justify-end gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                <button type="button" 
                        class="py-2 px-3 rounded-lg border bg-white text-gray-800 hover:bg-gray-50 dark:bg-neutral-800 dark:text-white"
                        onclick="toggleModal('{{ $modalId ?? 'hs-scale-animation-modal' }}')">
                    Close
                </button>
                <button type="button" 
                        class="py-2 px-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden');
            modal.classList.toggle('pointer-events-none');
        }
    }
</script> --}}
