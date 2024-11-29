<div>
    <x-slot:title>Chat-Bertani.com</x-slot:title>
    <div class="mb-10 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8 ">

        {{-- tabel --}}
        <div class="grid grid-cols-3 rounded-md border border-black">
            {{-- list kontak --}}
            <div class="border-r border-black">
                {{-- container kontak orang --}}
                <div class="grid grid-flow-row pt-3">
                    <div
                        class="pt-0 md:pt-3 pb-4 md:pb-7 border-b border-black text-2xl font-libre-franklin font-bold tracking-tight text-gray-900 flex justify-center items-center">
                        CHAT
                    </div>
                    {{-- container nama kontak --}}
                    <div class="h-auto min-h-[10rem] md:min-h-[25rem] lg:min-h-[32rem] overflow-y-auto">
                        @foreach ($contacts as $contact)
                            <a href="{{ route('chat', $contact->slug) }}" wire:navigate>
                                <button
                                    class="py-1 w-full pl-1 md:pl-4 pt-4 pb-4 flex items-center justify-start gap-x-1 md:gap-x-0 text-xs md:text-xl font-hind font-medium {{ request()->is(route('chat', $contact->slug)) ? 'bg-green-400' : 'hover:bg-green-300' }}">
                                    <span>
                                        {{-- @if ($user && $user->profile_img_link) --}}
                                        {{-- <img src="./img/bglogin.jpg" alt=""
                                class="w-4 h-4 md:w-8 md:h-8 md:mr-5 rounded-full object-cover group-hover:text-green-600"> --}}
                                        {{-- @elseif ($user) --}}
                                        @if ($contact->profile_img_link)
                                            {{-- tambahkan gambar --}}
                                            <ion-icon name="person-circle-outline"
                                                class="w-4 h-4 md:w-8 md:h-8 md:pr-5 flex justify-center"></ion-icon>
                                        @else
                                            <ion-icon name="person-circle-outline"
                                                class="w-4 h-4 md:w-8 md:h-8 md:pr-5 flex justify-center"></ion-icon>
                                        @endif
                                    </span>
                                    {{ $contact->name }}
                                </button>
                            </a>
                        @endforeach
                    </div>


                </div>
            </div>
            {{-- end list kontak / kotak kiri --}}


            {{-- kotak kanan/ isi pesan --}}
            <div class="col-span-2">
                @if ($content)
                    {{-- nama kontak --}}
                    <div class="grid grid-flow-row pt-3">
                        {{-- nama kontak --}}
                        <div class="pl-3 pb-3 border-b border-black font-bold tracking-tight text-gray-900">
                            <div class="relative flex items-center space-x-4">
                                <div class="relative">
                                    {{-- <span class="absolute text-green-500 right-0 bottom-0">
                                    <svg width="20" height="20">
                                        <circle cx="8" cy="8" r="8" fill="currentColor"></circle>
                                    </svg>
                                </span> --}}
                                    <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                                        alt="" class="w-6 md:w-10 h-6 md:h-10 rounded-full">
                                </div>
                                <div class="flex flex-col leading-tight">
                                    {{-- nama --}}
                                    <div class="text-xs md:text-xl font-hind font-bold mt-1 flex items-center">
                                        <span class="text-gray-700 mr-3">{{ $interlocutor->name }}</span>
                                    </div>
                                    {{-- role --}}
                                    <span class="text-xs md:text-lg font-hind font-medium text-gray-600">{{ $interlocutor->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class=" h-auto min-h-[10rem] md:min-h-[25rem] lg:min-h-[32rem] overflow-y-auto">
                            @include('components.room-chat')
                        </div>
                    </div>
                @else
                    pilih kontak di samping untuk memulai chat
                @endif
            </div>
            {{-- end kotak kanan/ isi pesan --}}
        </div>
        {{-- end tabel --}}

    </div>
</div>
