<div class="bg-gray-200 rounded-lg mb-4 mx-auto max-w-7xl px-4 mt-5 sm:px-6 lg:px-8">
    <x-slot:title>Admin-Laporan-Bertani.com</x-slot:title>
    <section class="py-7 bg-gray-200">
        {{-- Filter Select --}}
        <div class="mb-4 max-lg:max-w-xl max-lg:mx-auto flex">
            <label for="filter" class="text-sm md:text-base lg:text-md text-black px-4 font-semibold">
                Tampilkan Berdasarkan
            </label>
            <select wire:model="filter"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-1 px-4">
                <option value="all" wire:click='getReports'>Semua</option>
                <option value="buyer" wire:click='getReports'>Pembeli</option>
                <option value="farmer" wire:click='getReports'>Petani</option>
                <option value="system" wire:click='getReports'>Sistem</option>
            </select>
        </div>

        {{-- Flash Message --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('message') }}
            </div>
        @endif

        {{-- Reports List --}}
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            @foreach ($reportDetails as $reportDetail)
                @php
                    $report = $reportDetail->report;
                    $reporter = $report->reporter;
                    $person = $reporter == 'buyer' ? $report->buyer : $report->farmer;
                @endphp
                
                <div class="box p-4 rounded-3xl bg-white mb-7 transition-all duration-500 max-lg:max-w-xl max-lg:mx-auto flex relative">
                    <input type="checkbox" class="self-center mr-4">
                    
                    <div class="w-20 flex-shrink-0 mr-4 flex items-center">
                        <img src="https://pagedone.io/asset/uploads/1705474950.png" alt="profile image"
                            class="rounded-md object-cover">
                    </div>
                    
                    <div class="flex flex-col justify-start items-start space-y-4 flex-grow">
                        <div class="flex items-center space-x-4">
                            <h3 class="text-sm md:text-lg lg:text-xl font-semibold leading-6 text-gray-800">
                                {{ $person->name }}
                            </h3>
                            <p class="text-xs md:text-sm lg:text-base font-medium text-gray-400">
                                {{ $reporter == 'buyer' ? 'PEMBELI' : 'PETANI' }}
                            </p>
                        </div>
                        
                        <div class="flex flex-col space-y-2 w-full" style="padding-right: 4rem;">
                            <p class="text-sm md:text-md lg:text-lg leading-none text-black font-bold">
                                Laporan : {{ Str::limit($reportDetail->content_of_report, 100) }}
                            </p>
                            <p class="text-xs md:text-sm lg:text-base leading-none text-black font-normal">
                                Dilaporkan pada {{ $reportDetail->report_time->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <div class="absolute bottom-4 right-4 flex space-x-2">
                        <button wire:click='popUpTanggapan({{ $reportDetail->id }})'>
                            <img src="/img/paperplane.png" alt="icon_teruskan" class="w-5 h-5 md:w-8 md:h-8">
                        </button>
                        <button wire:click="deleteReport({{ $reportDetail->id }})">
                            <img src="/img/trash.png" alt="icon_sampah" class="w-5 h-5 md:w-8 md:h-8">
                        </button>
                    </div>
                </div>
            @endforeach

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $reportDetails->links() }}
            </div>
        </div>
    </section>

    <!-- Popup untuk mengirim laporan -->
    <div id="teruskan" class="{{ $popup_tanggapan }} fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg w-full max-w-lg relative">
            <!-- Tombol Tutup Popup -->
            <button wire:click='tutup' class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <!-- Konten Popup -->
            <h2 class="text-xl font-semibold mb-4 text-center">Kirim Laporan</h2>

            <!-- Foto Profil Pengguna -->
            <div class="flex items-center justify-center mb-4">
                <img src="https://pagedone.io/asset/uploads/1705474950.png" alt="Foto Profil"
                    class="w-24 h-24 rounded-full">
            </div>

            <div class="mb-12 flex flex-col justify-start items-start space-y-4 flex-grow">
                <div class="flex items-center space-x-4">
                    <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800">{{ $user ? $user->name : '' }}</h3>
                    <p class="text-lg font-medium text-gray-400">{{ $role }}</p>
                </div>
                <div class="mb-12 flex flex-col space-y-2 w-full" style="padding-right: 2rem;">
                    <p class="text-lg leading-none text-black font-semibold">Laporan : {{ $isiLaporan }}</p>
                </div>
            </div>

            {{-- <div class="mb-4">
                <input type="file" id="uploadImage" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500
            file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-700 
            file:text-white hover:file:bg-blue-500 active:scale-95">
            </div> --}}
            @if ($detailLaporan && $detailLaporan->img)
                <a href="{{ route('image-show', $detailLaporan->id) }}" target="_blank">
                    <button>Lihat lampiran</button>
                </a>
            @endif

            <!-- Textbox untuk menulis pesan -->
            <div class="mb-4">
                <label for="message" class="block text-sm font-normal text-gray-700">Tulis pesan untuk pelapor</label>
                <textarea id="message" rows="3" placeholder="" wire:model.lazy="message"
                    class="w-full p-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Tombol aksi -->
            <div class="flex justify-end space-x-4">
                <button wire:click="tutup" class="px-4 py-2 bg-gray-300 rounded-lg">Batal</button>
                <button wire:click="kirimTanggapan" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Kirim</button>
            </div>
        </div>
    </div>
</div>