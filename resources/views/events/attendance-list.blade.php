@extends('layouts.app')

@section('title', 'Pilih Event Kehadiran')

@section('content')
<div class="max-w-md mx-auto bg-white min-h-screen shadow-lg relative">
    @include('components.debug-sidebar')

    <!-- Header -->
    <div class="p-6 border-b flex items-center justify-between">
        <button id="menuToggle" class="p-2 rounded-full hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h1 class="text-xl font-bold text-center flex-1">Pilih Event Kehadiran</h1>
    </div>

    <!-- Event List -->
    <div class="p-6 mb-4 space-y-5"> <!-- space-y-5 = lebih lega -->
        @forelse ($events as $event)
            <a href="{{ route('attendance.show', $event->event_id) }}"
                class="block p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition border">

                <div class="flex justify-between items-center">
                    
                    <div class="space-y-1">
                        <!-- Judul Event -->
                        <h2 class="font-bold text-lg">{{ $event->title }}</h2>

                        <!-- Nama Kegiatan / Deskripsi -->
                        @if($event->nama_kegiatan)
                            <p class="text-gray-500 text-sm">
                                {{ $event->nama_kegiatan }}
                            </p>
                        @else
                            <p class="text-gray-400 text-sm italic">Tidak ada deskripsi</p>
                        @endif

                        <!-- Tanggal -->
                        <p class="text-gray-600 text-sm">
                            {{ \Carbon\Carbon::parse($event->start_at)->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>

                </div>
            </a>
        @empty
            <p class="text-center text-gray-500">Belum ada event yang tersedia.</p>
        @endforelse
    </div>
</div>

<script>
document.getElementById('menuToggle').addEventListener('click', () => {
    document.getElementById('debugMenu').classList.toggle('hidden');
});
</script>

@endsection
