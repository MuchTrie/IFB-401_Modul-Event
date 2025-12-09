@php
use Carbon\Carbon;

// daftar bulan
$months = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei',
    6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober',
    11 => 'November', 12 => 'Desember',
];

// bulan & tahun aktif
$currentMonth = request('month', now()->month);
$currentYear = request('year', now()->year);

$date = Carbon::create($currentYear, $currentMonth, 1);

$monthName = $date->translatedFormat('F Y');
$daysInMonth = $date->daysInMonth;
$startDay = $date->dayOfWeek;
$today = Carbon::today();
@endphp

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
            <div class="text-center mb-4 flex justify-between items-center">
                <form method="GET" class="flex gap-2 w-full justify-center">
                    {{-- Dropdown Bulan --}}
                    <select name="month" onchange="this.form.submit()" class="border rounded-lg px-3 py-1.5">
                        @foreach($months as $num => $name)
                            <option value="{{ $num }}" {{ $num == $currentMonth ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Dropdown Tahun --}}
                    <select name="year" onchange="this.form.submit()" class="border rounded-lg px-3 py-1.5">
                        @for ($y = now()->year - 5; $y <= now()->year + 5; $y++)
                            <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </form>
            </div>

            {{-- Days of Week --}}
            <div class="grid grid-cols-7 gap-2 mb-2 text-sm font-medium text-gray-600">
                <div class="text-center p-2">M</div>
                <div class="text-center p-2">S</div>
                <div class="text-center p-2">S</div>
                <div class="text-center p-2">R</div>
                <div class="text-center p-2">K</div>
                <div class="text-center p-2">J</div>
                <div class="text-center p-2">S</div>
            </div>

            {{-- Calendar Dates --}}
            <div class="grid grid-cols-7 gap-2">
                {{-- Kosongkan kotak sebelum tanggal 1 --}}
                @for ($i = 0; $i < $startDay; $i++)
                    <div class="aspect-square"></div>
                @endfor

                {{-- Tanggal --}}
                @for ($i = 1; $i <= $daysInMonth; $i++)
                    @if($today->day == $i && $today->month == $currentMonth && $today->year == $currentYear)
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
            @foreach($events as $event)
                <button 
                    class="block"
                    data-event='@json($event)'
                    onclick="openModal(this.dataset.event)">

                    <div class="bg-gray-100 rounded-xl p-4 hover:bg-gray-200 transition cursor-pointer">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-gray-300 rounded-lg flex items-center justify-center">
                                @if($event->poster)
                                    <img src="{{ $event->poster }}" class="w-12 h-12 object-cover rounded-lg" alt="Poster">
                                @else
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="h-16 bg-gray-200 rounded mb-2 flex items-center justify-center text-xs text-gray-500 text-center px-1">
                            {{ $event->nama_kegiatan }}
                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div id="eventModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-end justify-center p-4">
        <div class="bg-white rounded-t-3xl w-full max-w-md max-h-[90vh] p-3 overflow-y-auto animate-slide-up" style="margin-top: auto;">
            <!-- Header -->
            <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center rounded-t-3xl z-20">
                <h2 class="text-xl font-bold text-[#315A62]">Detail Event</h2>
                <button onclick="closeModal()" class="p-2 hover:bg-gray-100 rounded-xl transition">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="mb-4 bg-gradient-to-br from-gray-200 to-gray-100 rounded-2xl overflow-hidden shadow-lg" style="height: 300px;">
                    <img id="modalEventPoster" 
                        src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://via.placeholder.com/400x300?text=No+Poster' }}" 
                        alt="Poster Event">
                </div>

                <h3 id="modalEventTitle" class="text-xl font-bold text-[#315A62] mb-2"></h3>
                <div class="flex items-center gap-2 text-gray-600 mb-4">
                    <svg class="w-5 h-5 text-[#EDD06B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span id="modalEventDate" class="text-sm"></span>
                </div>

                <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                    <h4 class="font-bold text-[#315A62] mb-2 text-sm">Deskripsi</h4>
                    <p id="modalEventDesc" class="text-gray-700 text-sm leading-relaxed"></p>
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-600 mb-6 bg-blue-50 p-3 rounded-xl">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Peserta Terdaftar: <strong id="modalEventAttendees"></strong></span>
                </div>

                <a href="" id="modalEventLink" class="block w-full bg-black text-white text-center font-bold py-4 rounded-2xl hover:shadow-lg transition-all duration-300">
                    Lihat Detail Lengkap
                </a>
            </div>
        </div>
    </div>

    <!-- Kegiatan Rutin (Placeholder) -->
    <div class="px-6 pb-6">
        <h2 class="text-lg font-bold mb-4">Kegiatan Rutin</h2>
        <div class="space-y-3">
            <div class="flex items-center gap-3 p-4 bg-gray-100 rounded-xl">
                <div class="w-16 h-16 bg-gray-300 rounded-lg flex-shrink-0"></div>
                <div class="flex-1 h-4 bg-gray-300 rounded"></div>
            </div>
            <div class="flex items-center gap-3 p-4 bg-gray-100 rounded-xl">
                <div class="w-16 h-16 bg-gray-300 rounded-lg flex-shrink-0"></div>
                <div class="flex-1 h-4 bg-gray-300 rounded"></div>
            </div>
        </div>
    </div>

</div>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    @keyframes slide-up { from { transform: translateY(100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    .animate-slide-up { animation: slide-up 0.5s ease-out; }
</style>
@endsection

@push('scripts')
<script>
function openModal(eventData) {
    const event = JSON.parse(eventData);
    document.getElementById('modalEventTitle').textContent = event.nama_kegiatan;
    document.getElementById('modalEventDesc').textContent = event.description ?? '-';
    document.getElementById('modalEventAttendees').textContent = (event.attendees ?? 0) + ' orang';
    const startDate = new Date(event.start_at);
    document.getElementById('modalEventDate').textContent = startDate.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    document.getElementById('modalEventPoster').src = event.poster ? `/storage/${event.poster}` : 'https://via.placeholder.com/400x300?text=No+Poster';
    document.getElementById('modalEventLink').href = `/events/${event.event_id}`;
    const modal = document.getElementById('eventModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

document.getElementById('eventModal').addEventListener('click', function(e) {
    if(e.target === this) closeModal();
});

document.addEventListener('keydown', function(e) {
    if(e.key === 'Escape') closeModal();
});
</script>
@endpush
