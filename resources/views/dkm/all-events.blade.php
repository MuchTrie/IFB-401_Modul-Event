<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Events
            </h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Tabs -->
            <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
                <div class="flex gap-4">
                    <a href="{{ route('dkm.all-events', ['filter' => 'all']) }}" 
                       class="px-6 py-2 rounded-lg font-semibold transition {{ $filter === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        All Events
                    </a>
                    <a href="{{ route('dkm.all-events', ['filter' => 'approved']) }}" 
                       class="px-6 py-2 rounded-lg font-semibold transition {{ $filter === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Approved
                    </a>
                    <a href="{{ route('dkm.all-events', ['filter' => 'rejected']) }}" 
                       class="px-6 py-2 rounded-lg font-semibold transition {{ $filter === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Rejected
                    </a>
                </div>
            </div>

            <!-- Events List -->
            @if($events->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        {{ $filter === 'approved' ? 'Approved Events' : ($filter === 'rejected' ? 'Rejected Events' : 'All Events') }} 
                        ({{ $events->total() }})
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($events as $event)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h4 class="text-xl font-bold text-gray-900">{{ $event->nama_kegiatan }}</h4>
                                        @if($event->status === 'published')
                                        <span class="ml-3 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                        @elseif($event->status === 'cancelled')
                                        <span class="ml-3 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
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
                                                <span class="font-semibold">Kuota:</span> {{ $event->kuota ?? 'Tidak terbatas' }}
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
                                                <span class="font-semibold">Diajukan oleh:</span> {{ $event->creator ? $event->creator->nama_lengkap : 'Unknown' }}
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

                            <!-- Action Button -->
                            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                                <button type="button" onclick="openDetailModal({{ $event->event_id }})" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $events->appends(['filter' => $filter])->links() }}
                    </div>
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Event</h3>
                    <p class="text-gray-600">Belum ada event {{ $filter === 'approved' ? 'yang disetujui' : ($filter === 'rejected' ? 'yang ditolak' : '') }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modal Detail Event -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">Detail Event</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-bold">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4">
                <!-- Status Badge -->
                <div id="modalStatusContainer" class="mb-4">
                    <span id="modalStatus" class="px-3 py-1 text-sm font-semibold rounded-full"></span>
                </div>

                <!-- Poster -->
                <div id="modalPosterContainer" class="mb-6 hidden">
                    <img id="modalPoster" src="" alt="Event Poster" class="w-full h-96 object-cover rounded-lg cursor-pointer" onclick="openImageModal(this.src)">
                </div>

                <!-- Event Info -->
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold text-gray-700">Kuota</h4>
                            <p id="modalKuota" class="text-gray-900"></p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Diajukan oleh</h4>
                            <p id="modalCreator" class="text-gray-900"></p>
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
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end pt-4 border-t mt-6">
                <button onclick="closeDetailModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Zoom Poster -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 hidden flex items-center justify-center z-50" onclick="closeImageModal()">
        <img id="modalImage" src="" class="max-w-full max-h-screen rounded-lg shadow-lg">
    </div>

    <script>
        const events = @json($events->items());

        function openDetailModal(eventId) {
            const event = events.find(e => e.event_id === eventId);
            if (!event) return;

            // Set status badge
            const statusBadge = document.getElementById('modalStatus');
            if (event.status === 'published') {
                statusBadge.textContent = 'Approved';
                statusBadge.className = 'px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800';
            } else if (event.status === 'cancelled') {
                statusBadge.textContent = 'Rejected';
                statusBadge.className = 'px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800';
            }

            // Set modal content
            document.getElementById('modalNamaKegiatan').textContent = event.nama_kegiatan;
            document.getElementById('modalJenis').textContent = event.jenis_kegiatan || 'Umum';
            document.getElementById('modalLokasi').textContent = event.lokasi || '-';
            document.getElementById('modalStartAt').textContent = new Date(event.start_at).toLocaleString('id-ID', { 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            document.getElementById('modalEndAt').textContent = new Date(event.end_at).toLocaleString('id-ID', { 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            document.getElementById('modalKuota').textContent = event.kuota || 'Tidak terbatas';
            document.getElementById('modalCreator').textContent = event.creator ? event.creator.nama_lengkap : 'Unknown';

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

            // Show modal
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function openImageModal(imageSrc) {
            event.stopPropagation();
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target.id === 'detailModal') {
                closeDetailModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
                closeImageModal();
            }
        });
    </script>
</x-app-layout>
