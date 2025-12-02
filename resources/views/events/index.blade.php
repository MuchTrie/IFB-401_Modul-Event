@extends('layouts.app')

@section('title', 'Jadwal Kegiatan & Event - Masjid Al-Nassr')

@section('content')
<div class="max-w-md mx-auto bg-white min-h-screen shadow-lg">
    <!-- Header -->
    <div class="p-6 border-b">
        <div class="flex items-center justify-between mb-4">
            <button id="menuToggle" class="p-2 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <h1 class="text-xl font-bold text-center">Jadwal Kegiatan & Event</h1>
        <p class="text-center text-gray-600">Masjid Al-Nassr</p>
    </div>

    @include('components.debug-sidebar')

        <!-- Calendar -->
        <div class="p-6">
            <div class="bg-gray-100 rounded-2xl p-4">
                <div class="text-center mb-4">
                    <h2 class="text-lg font-semibold">November 2025</h2>
                </div>
                
                <!-- Days of Week -->
                <div class="grid grid-cols-7 gap-2 mb-2">
                    <div class="text-center text-sm font-medium text-gray-600 p-2">S</div>
                    <div class="text-center text-sm font-medium text-gray-600 p-2">M</div>
                    <div class="text-center text-sm font-medium text-gray-600 p-2">T</div>
                    <div class="text-center text-sm font-medium text-gray-600 p-2">W</div>
                    <div class="text-center text-sm font-medium text-gray-600 p-2">T</div>
                    <div class="text-center text-sm font-medium text-gray-600 p-2">F</div>
                    <div class="text-center text-sm font-medium text-gray-600 p-2">S</div>
                </div>

                <!-- Calendar Dates -->
                <div class="grid grid-cols-7 gap-2">
                    @for ($i = 1; $i <= 30; $i++)
                        @if ($i == 16)
                            <button class="aspect-square bg-gray-800 text-white rounded-lg p-2 text-sm font-medium hover:bg-gray-700">
                                {{ $i }}
                            </button>
                        @else
                            <button class="aspect-square bg-white rounded-lg p-2 text-sm font-medium hover:bg-gray-50">
                                {{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
        </div>

        <!-- Event Terdekat -->
        <div class="px-6 pb-4">
            <h2 class="text-lg font-bold mb-4">Event Terdekat</h2>
            <div class="grid grid-cols-3 gap-3">
                <!-- Event Card 1 -->
                <button onclick="openModal(1)" class="block">
                    <div class="bg-gray-100 rounded-xl p-4 hover:bg-gray-200 transition cursor-pointer">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="h-16 bg-gray-200 rounded mb-2 flex items-center justify-center text-xs text-gray-500">
                            Event 1
                        </div>
                    </div>
                </button>

                <!-- Event Card 2 -->
                <button onclick="openModal(2)" class="block">
                    <div class="bg-gray-100 rounded-xl p-4 hover:bg-gray-200 transition cursor-pointer">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="h-16 bg-gray-200 rounded mb-2 flex items-center justify-center text-xs text-gray-500">
                            Event 2
                        </div>
                    </div>
                </button>

                <!-- Event Card 3 -->
                <button onclick="openModal(3)" class="block">
                    <div class="bg-gray-100 rounded-xl p-4 hover:bg-gray-200 transition cursor-pointer">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="h-16 bg-gray-200 rounded mb-2 flex items-center justify-center text-xs text-gray-500">
                            Event 3
                        </div>
                    </div>
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div id="eventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center rounded-t-2xl">
                    <h2 class="text-xl font-bold">Detail Event</h2>
                    <button onclick="closeModal()" class="p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    <!-- Event Poster -->
                    <div class="mb-4 bg-gray-200 rounded-xl overflow-hidden" style="height: 300px;">
                        <div class="w-full h-full flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="font-medium">Poster Event</p>
                            </div>
                        </div>
                    </div>

                    <!-- Event Info -->
                    <h3 id="modalEventTitle" class="text-xl font-bold mb-2">Nama Event</h3>
                    <p class="text-gray-600 mb-4">Tanggal: <span id="modalEventDate">17 November 2025</span></p>
                    
                    <div class="mb-4">
                        <h4 class="font-bold mb-2">Deskripsi</h4>
                        <p id="modalEventDesc" class="text-gray-700">Deskripsi event akan muncul di sini...</p>
                    </div>

                    <p class="text-sm text-gray-600 mb-4">Peserta Terdaftar: <span id="modalEventAttendees" class="font-semibold">xxxx</span></p>

                    <!-- Action Button -->
                    <a href="{{ route('events.show', 1) }}" id="modalEventLink" class="block w-full bg-gray-800 text-white text-center font-bold py-3 rounded-full hover:bg-gray-900 transition">
                        Lihat Detail Lengkap
                    </a>
                </div>
            </div>
        </div>

        <!-- Kegiatan Rutin -->
        <div class="px-6 pb-6">
            <h2 class="text-lg font-bold mb-4">Kegiatan Rutin</h2>
            <div class="space-y-3">
                <!-- Kegiatan Item 1 -->
                <div class="flex items-center gap-3 p-4 bg-gray-100 rounded-xl">
                    <div class="w-16 h-16 bg-gray-300 rounded-lg flex-shrink-0"></div>
                    <div class="flex-1 h-4 bg-gray-300 rounded"></div>
                </div>

                <!-- Kegiatan Item 2 -->
                <div class="flex items-center gap-3 p-4 bg-gray-100 rounded-xl">
                    <div class="w-16 h-16 bg-gray-300 rounded-lg flex-shrink-0"></div>
                    <div class="flex-1 h-4 bg-gray-300 rounded"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Modal functions
    function openModal(eventId) {
        const modal = document.getElementById('eventModal');
        const modalLink = document.getElementById('modalEventLink');
        
        // Update modal link
        modalLink.href = `/events/${eventId}`;
        
        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('eventModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('eventModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
