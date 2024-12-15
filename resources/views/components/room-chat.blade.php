<div class="pl-4 pt-2 pb-4 justify-between flex flex-col h-screen">
    <div id="messages"
        class="flex flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch flex-grow pb-16">
        @foreach ($content as $message)
            @if ($message->role == 'receiver')
                <div class="chat-message">
                    <div class="flex items-end">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                            <div>
                                <span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white"
                                    style="max-width: 100%; word-wrap: break-word; white-space: normal;">
                                    {{ $message->content }}
                                </span>
                                <span class="text-gray-600 text-[10px] ml-2">
                                    {{ $message->send_time->format('H:i') }}
                                </span>
                            </div>
                        </div>
                        @if ($friend->profile_img_link)
                            <img src="{{ $friend->profile_img_link }}" alt="My profile"
                                class="w-6 h-6 rounded-full order-1">
                        @else
                            <ion-icon wire:ignore name="person-circle-outline" class="w-6 h-6 rounded-full order-1"></ion-icon>
                        @endif
                    </div>
                </div>
            @else
                <div class="chat-message">
                    <div class="flex items-end justify-end">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                            <div>
                                <span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white"
                                    style="max-width: 100%; word-wrap: break-word; white-space: normal;">
                                    {{ $message->content }}
                                </span>
                            </div>
                            <span class="text-gray-600 text-[10px] mt-1">
                                {{ $message->send_time->format('H:i') }}
                            </span>
                        </div>

                        @if ($user->profile_img_link)
                            <img src="{{ $user->profile_img_link }}" alt="My profile"
                                class="w-6 h-6 rounded-full order-2">
                        @else
                            <ion-icon wire:ignore name="person-circle-outline" class="w-6 h-6 rounded-full order-1"></ion-icon>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div id="kotakinput" class="bottom-0 bg-white z-10 border-t-2 border-gray-700 px-4 pt-4 mb-2">
        <div class="relative flex items-center">
            <!-- Input Field -->
            <div class="w-full">
                <input type="text" id="messageInput" placeholder="Write your message!"
                    class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-3 md:pl-8 pr-12 md:pr-20 bg-gray-200 rounded-md py-3 resize-none overflow-auto text-xs md:text-lg"
                    oninput="autoResize(this); cekTyping(this)" wire:model.lazy="message"
                    wire:keydown.enter="kirimPesan" onkeydown="clearInputOnEnter(event)">
            </div>

            <!-- Send Button -->
            <button id="tombolKirim" type="button" wire:click="kirimPesan"
                onclick="getElementById('messageInput').value = ''"
                class="absolute right-0 inline-flex items-center justify-center rounded-lg px-2 py-1 md:px-4 md:py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none text-xs md:text-lg opacity-50 cursor-not-allowed">
                {{-- <span class="font-bold">Send</span> --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="h-6 w-6 transform rotate-90">
                    <path
                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    .scrollbar-w-2::-webkit-scrollbar {
        width: 0.25rem;
        height: 0.5rem;
    }

    .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
        --bg-opacity: 1;
        background-color: #1d2124;
        background-color: rgba(247, 250, 252, var(--bg-opacity));
    }

    .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
        --bg-opacity: 1;
        background-color: #539de8;
        background-color: rgba(237, 242, 247, var(--bg-opacity));
    }

    .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
        border-radius: 0.25rem;
    }
</style>

<script>
    function clearInputOnEnter(event) {
        // Cek apakah tombol yang ditekan adalah Enter (keyCode 13)
        if (event.keyCode === 13) {
            // Kosongkan input
            document.getElementById('messageInput').value = '';
        }
    }

    function cekTyping(input) {
        let tombolKirim = document.getElementById('tombolKirim');
        if (input.value.trim() === '') {
            tombolKirim.disabled = true;
            tombolKirim.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            tombolKirim.disabled = false;
            tombolKirim.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    const el = document.getElementById('messages');
    el.scrollTop = el.scrollHeight;

    function autoResize(input) {
        input.style.height = 'auto';
        input.style.height = input.scrollHeight + 'px';
    }
</script>
