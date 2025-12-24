<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Event Saya
            </h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
            @endif

            <!-- My Events List -->
            @if($myEvents->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Event Yang Saya Ikuti ({{ $myEvents->count() }})</h3>
                    
                    <div class="space-y-4">
                        @foreach($myEvents as $item)
                        @php
                            $event = $item['event'];
                            $sesi = $item['sesi'];
                            $attendanceStatus = $item['attendance_status'];
                            $isUpcoming = \Carbon\Carbon::parse($event->start_at)->isFuture();
                            $isPast = \Carbon\Carbon::parse($event->end_at)->isPast();
                        @endphp
                        
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition {{ $isPast ? 'bg-gray-50' : '' }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2 gap-2">
                                        <h4 class="text-xl font-bold text-gray-900">{{ $event->nama_kegiatan }}</h4>
                                        
                                        <!-- Status Badge -->
                                        @if($isPast)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Selesai
                                        </span>
                                        @elseif($isUpcoming)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Akan Datang
                                        </span>
                                        @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Sedang Berlangsung
                                        </span>
                                        @endif

                                        <!-- Attendance Status -->
                                        @if($attendanceStatus === 'hadir')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            ✓ Hadir
                                        </span>
                                        @elseif($attendanceStatus === 'tidak_hadir')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            ✗ Tidak Hadir
                                        </span>
                                        @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            ⏱ Belum Absen
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold">Jenis:</span> {{ $event->jenis_kegiatan ?? 'Umum' }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold">Lokasi:</span> {{ $event->lokasi ?? '-' }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold">Sesi:</span> {{ $sesi->nama_sesi }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold">Tanggal Mulai:</span> {{ \Carbon\Carbon::parse($event->start_at)->format('d M Y, H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold">Tanggal Selesai:</span> {{ \Carbon\Carbon::parse($event->end_at)->format('d M Y, H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold">Terdaftar pada:</span> {{ \Carbon\Carbon::parse($item['registered_at'])->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($event->description)
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-gray-600 mb-1">Deskripsi:</p>
                                        <p class="text-sm text-gray-700 line-clamp-2">{{ $event->description }}</p>
                                    </div>
                                    @endif
                                </div>

                                @if($event->poster)
                                <div class="ml-6 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->nama_kegiatan }}" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                                <button type="button" onclick="openDetailModal({{ $event->event_id }})" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </button>

                                @if($isUpcoming && $attendanceStatus !== 'hadir')
                                <form action="{{ route('events.unregister', $event->event_id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition" onclick="return confirm('Yakin ingin membatalkan pendaftaran?')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Batal Daftar
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Event Terdaftar</h3>
                    <p class="text-gray-600 mb-4">Anda belum mendaftar untuk event apapun</p>
                    <a href="{{ route('jemaah.calendar') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Lihat Kalender Event
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modal Detail Event -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-2xl font-bold text-gray-900">Detail Event</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-bold">&times;</button>
            </div>

            <div class="mt-4">
                <div id="modalPosterContainer" class="mb-6 hidden">
                    <img id="modalPoster" src="" alt="Event Poster" class="w-full h-96 object-cover rounded-lg">
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-700">Nama Event</h4>
                        <p id="modalNamaKegiatan" class="text-gray-900"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold text-gray-700">Jenis</h4>
                            <p id="modalJenis" class="text-gray-900"></p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Lokasi</h4>
                            <p id="modalLokasi" class="text-gray-900"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold text-gray-700">Tanggal Mulai</h4>
                            <p id="modalStartAt" class="text-gray-900"></p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Tanggal Selesai</h4>
                            <p id="modalEndAt" class="text-gray-900"></p>
                        </div>
                    </div>

                    <div id="modalDescriptionContainer" class="hidden">
                        <h4 class="font-semibold text-gray-700">Deskripsi</h4>
                        <p id="modalDescription" class="text-gray-900"></p>
                    </div>

                    <div id="modalRuleContainer" class="hidden">
                        <h4 class="font-semibold text-gray-700">Ketentuan</h4>
                        <p id="modalRule" class="text-gray-900"></p>
                    </div>

                    <div id="modalAttendanceContainer" class="hidden">
                        <h4 class="font-semibold text-gray-700">Status Kehadiran</h4>
                        <p id="modalAttendance" class="text-gray-900"></p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t mt-6">
                <button onclick="closeDetailModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        const myEvents = @json($myEvents->values()->all());

        function openDetailModal(eventId) {
            const item = myEvents.find(e => e.event.event_id === eventId);
            if (!item) return;

            const event = item.event;
            
            document.getElementById('modalNamaKegiatan').textContent = event.nama_kegiatan;
            document.getElementById('modalJenis').textContent = event.jenis_kegiatan || 'Umum';
            document.getElementById('modalLokasi').textContent = event.lokasi || '-';
            document.getElementById('modalStartAt').textContent = new Date(event.start_at).toLocaleString('id-ID', { 
                day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' 
            });
            document.getElementById('modalEndAt').textContent = new Date(event.end_at).toLocaleString('id-ID', { 
                day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' 
            });

            // Poster
            if (event.poster) {
                document.getElementById('modalPoster').src = '/storage/' + event.poster;
                document.getElementById('modalPosterContainer').classList.remove('hidden');
            } else {
                document.getElementById('modalPosterContainer').classList.add('hidden');
            }

            // Description
            if (event.description) {
                document.getElementById('modalDescription').textContent = event.description;
                document.getElementById('modalDescriptionContainer').classList.remove('hidden');
            } else {
                document.getElementById('modalDescriptionContainer').classList.add('hidden');
            }

            // Rule
            if (event.rule) {
                document.getElementById('modalRule').textContent = event.rule;
                document.getElementById('modalRuleContainer').classList.remove('hidden');
            } else {
                document.getElementById('modalRuleContainer').classList.add('hidden');
            }

            // Attendance Status
            const attendanceStatus = item.attendance_status;
            let statusText = 'Belum Absen';
            if (attendanceStatus === 'hadir') statusText = '✓ Hadir';
            if (attendanceStatus === 'tidak_hadir') statusText = '✗ Tidak Hadir';
            
            document.getElementById('modalAttendance').textContent = statusText;
            document.getElementById('modalAttendanceContainer').classList.remove('hidden');

            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target.id === 'detailModal') closeDetailModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDetailModal();
        });
    </script>
</x-app-layout>
