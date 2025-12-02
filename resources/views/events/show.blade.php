@extends('layouts.app')

@section('title', 'Detail Event')

@section('content')
<div class="max-w-md mx-auto bg-white min-h-screen shadow-lg">
    <!-- Header -->
    <div class="p-6 border-b">
        <div class="flex items-center gap-4">
            <a href="{{ route('events.index') }}" class="p-2 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Event Image/Poster -->
        <div class="p-6">
            <div class="bg-gray-200 rounded-2xl overflow-hidden mb-6" style="height: 400px;">
                <div class="w-full h-full flex items-center justify-center text-gray-500">
                    <div class="text-center">
                        <svg class="w-20 h-20 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="font-medium">Gambar/Poster Event</p>
                    </div>
                </div>
            </div>

            <!-- Carousel Dots -->
            <div class="flex justify-center gap-2 mb-6">
                <div class="w-2 h-2 bg-gray-800 rounded-full"></div>
                <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
            </div>
        </div>

        <!-- Event Details -->
        <div class="px-6 pb-6">
            <h1 class="text-2xl font-bold mb-2">Nama Event</h1>
            <p class="text-gray-600 mb-6">Tanggal</p>

            <h2 class="text-lg font-bold mb-3">Deskripsi</h2>
            <div class="space-y-2 mb-6">
                <div class="h-3 bg-gray-200 rounded w-full"></div>
                <div class="h-3 bg-gray-200 rounded w-full"></div>
                <div class="h-3 bg-gray-200 rounded w-11/12"></div>
                <div class="h-3 bg-gray-200 rounded w-full"></div>
                <div class="h-3 bg-gray-200 rounded w-10/12"></div>
            </div>

            <!-- Peserta Info -->
            <div class="mb-6">
                <p class="text-sm text-gray-600">Peserta Terdaftar: <span class="font-semibold">xx</span></p>
            </div>

            <!-- Action Button -->
            <button class="w-full bg-white border-2 border-gray-800 text-gray-800 font-semibold py-3 px-6 rounded-full hover:bg-gray-800 hover:text-white transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Daftar
            </button>
        </div>
    </div>

    <!-- Alternative: Registered State -->
    <!-- Uncomment this section to show registered state -->
    <!--
    <div class="max-w-md mx-auto bg-white min-h-screen shadow-lg hidden">
        <div class="px-6 pb-6">
            <button class="w-full bg-white border-2 border-gray-800 text-gray-800 font-semibold py-3 px-6 rounded-full hover:bg-gray-100 transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Terdaftar
            </button>
        </div>
    </div>
    -->
</div>
@endsection
