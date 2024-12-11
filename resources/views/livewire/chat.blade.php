<div>
    <x-slot:title>Chat-Bertani.com</x-slot:title>
    <div class="mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 h-[calc(100vh-5rem)] overflow-hidden">

        {{-- tabel --}}
        <div class="grid grid-cols-3 rounded-md border border-black h-full">
            {{-- list kontak --}}
            <div class="border-r border-black overflow-hidden">
                {{-- container kontak orang --}}
                <div class="grid grid-flow-row pt-3">
                    <div
                        class="pt-0 md:pt-3 pb-4 md:pb-7 border-b border-black text-2xl font-libre-franklin font-bold tracking-tight text-gray-900 flex justify-center items-center">
                        CHAT
                    </div>
                    {{-- container nama kontak --}}
                    <div class="h-full md:h-[calc(100vh-10rem)] overflow-y-auto">
                        @foreach ($contacts as $contact)
                            <a href="{{ route('chat', $contact['slug']) }}" wire:navigate>
                                <button
                                    class="py-1 w-full pl-1 md:pl-4 pt-4 pb-4 flex items-center justify-start gap-x-1 md:gap-x-0 text-xs md:text-base lg:text-xl font-hind font-medium {{ request()->is(route('chat', $contact['slug'])) ? 'bg-green-400' : 'hover:bg-green-300' }}">
                                    <span>
                                        @if ($contact['profile_img_link'])
                                            <img src="{{ $contact['profile_img_link']}}" alt="profile"
                                            class="w-6 h-6 object-cover md:w-8 md:h-8 mr-5 flex justify-center rounded-full">
                                        @else
                                            <ion-icon name="person-circle-outline"
                                                class="w-4 h-4 md:w-8 md:h-8 md:pr-5 flex justify-center"></ion-icon>
                                        @endif
                                    </span>
                                    @if ($contact['not_read'] > 0)
                                        {{ Str::limit($contact['name'], 15) }}
                                        <div class="inline-block ml-2 bg-green-500 text-white text-xs font-bold px-1 py-1 rounded-full min-w-[20px] text-center justify-center">
                                            {{ $contact['not_read'] }}
                                        </div>
                                    @else
                                        {{ Str::limit($contact['name'], 20) }}
                                    @endif
                                </button>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- end list kontak / kotak kiri --}}

            {{-- kotak kanan/ isi pesan --}}
            <div class="col-span-2 overflow-y-auto ">
                @if ($content)
                    {{-- nama kontak --}}
                    <div class="grid grid-flow-row pt-3 h-full overflow-y-auto">
                        {{-- nama kontak --}}
                        <div class="pl-3 pb-3 border-b border-black font-bold tracking-tight text-gray-900">
                            <div class="relative flex items-center space-x-4">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                                        alt="" class="w-6 md:w-10 h-6 md:h-10 rounded-full">
                                </div>
                                <div class="flex flex-col leading-tight">
                                    <div class="text-xs md:text-xl font-hind font-bold mt-1 flex items-center">
                                        <span class="text-gray-700 mr-3">{{ $friend->name }}</span>
                                    </div>
                                    <span class="text-xs md:text-lg font-hind font-medium text-gray-600">{{ $friend->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="h-full overflow-y-auto">
                            @include('components.room-chat')
                        </div>
                    </div>
                @else
                    <div class="flex justify-center font-libre-franklin font-medium place-content-center my-10 bg-green-400 text-xs md:text-lg">Pilih kontak di samping untuk memulai chat</div>
                @endif
            </div>
            {{-- end kotak kanan/ isi pesan --}}
        </div>
        {{-- end tabel --}}
    </div>
</div>
