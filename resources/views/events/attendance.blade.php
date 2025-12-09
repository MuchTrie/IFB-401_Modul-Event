@extends('layouts.app')

@section('title', 'Kehadiran Jamaah')

@section('content')
<div class="max-w-md mx-auto bg-white min-h-screen shadow-lg">
    @include('components.debug-sidebar')

    <!-- Header -->
    <div class="p-6 border-b">
        <div class="flex items-center justify-between mb-4">
            <button id="menuToggle" class="p-2 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Nama Event -->
        <h1 class="text-xl font-bold text-center">{{ $event->title }}</h1>

        <p class="text-center text-gray-500 text-sm mt-1">
            {{ \Carbon\Carbon::parse($event->start_at)->translatedFormat('d F Y, H:i') }}
        </p>

        <!-- 🔥 Nama Kegiatan -->
        @if($event->description)
        <p class="text-center text-gray-700 text-sm mt-2 font-medium">
            {{ $event->nama_kegiatan }}
        </p>
        @endif
    </div>

    <!-- Search Bar -->
    <div class="p-6">
        <div class="relative">
            <input type="text" placeholder="Cari Nama"
                class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-300">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Attendance List -->
    <div class="px-6 pb-6">
        
        <!-- 🔥 Judul daftar jamaah -->
        <h2 class="text-lg font-bold mb-4">Daftar Kehadiran</h2>

        <div class="space-y-3">
            @for ($i = 1; $i <= 10; $i++)
            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                <div class="flex-shrink-0">
                    <button class="w-8 h-8 border-2 border-gray-300 rounded-full hover:border-gray-400 transition"></button>
                </div>

                <div class="flex-1">
                    <div class="h-5 bg-gray-200 rounded w-3/4"></div>
                </div>

                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

<script>
document.getElementById('menuToggle').addEventListener('click', () => {
    document.getElementById('debugMenu').classList.toggle('hidden');
});
</script>

@endsection
