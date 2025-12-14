@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="max-w-md mx-auto bg-white min-h-screen shadow-lg">
    <!-- Header -->
    <div class="p-6 border-b">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.events.index') }}" class="p-2 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
        </div>
        <h1 class="text-xl font-bold text-center">Edit Event</h1>
    </div>

    <!-- Form -->
    <div class="p-6">
        <form action="{{ route('events.update', $event->event_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Kegiatan -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $event->nama_kegiatan) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800" placeholder="Masukkan nama kegiatan" required>
                @error('nama_kegiatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Kegiatan -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Jenis Kegiatan</label>
                <input type="text" name="jenis_kegiatan" value="{{ old('jenis_kegiatan', $event->jenis_kegiatan) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800" placeholder="Misal: Kajian, Pengajian, Lainnya">
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800" placeholder="Masukkan lokasi">
            </div>

            <!-- Start & End Datetime -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Waktu Mulai</label>
                <input type="datetime-local" name="start_at" value="{{ old('start_at', \Carbon\Carbon::parse($event->start_at)->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800" required>
                @error('start_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Waktu Selesai</label>
                <input type="datetime-local" name="end_at" value="{{ old('end_at', \Carbon\Carbon::parse($event->end_at)->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800" required>
                @error('end_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kuota -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Kuota (Opsional)</label>
                <input type="number" name="kuota" value="{{ old('kuota', $event->kuota) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800" placeholder="Masukkan kuota" min="0">
            </div>

            <!-- Rule -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Aturan / Rule (Opsional)</label>
                <textarea name="rule" rows="3" class="w-full px-4 py-3 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-gray-800 resize-none" placeholder="Masukkan aturan event...">{{ old('rule', $event->rule) }}</textarea>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" rows="5" class="w-full px-4 py-3 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-gray-800 resize-none" placeholder="Tulis deskripsi event...">{{ old('description', $event->description) }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Status</label>
                <select name="status" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800" required>
                    <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Current Poster -->
            @if($event->poster)
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Poster Saat Ini</label>
                <img src="{{ asset('storage/' . $event->poster) }}" alt="Current poster" class="w-full h-48 object-cover rounded-lg mb-2">
            </div>
            @endif

            <!-- Poster -->
            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Gambar/Poster Baru (Opsional)</label>
                <div class="relative">
                    <input type="file" name="poster" accept="image/*" class="hidden" id="file-upload">
                    <label for="file-upload" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full cursor-pointer hover:bg-gray-50 flex items-center justify-between">
                        <span class="text-gray-500">Upload File</span>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </label>
                    <p class="text-xs text-gray-500 mt-2" id="file-name"></p>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.events.index') }}" class="flex-1 bg-gray-300 text-gray-800 font-bold py-4 rounded-full hover:bg-gray-400 transition text-center">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-gray-800 text-white font-bold py-4 rounded-full hover:bg-gray-900 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('file-upload').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || '';
    document.getElementById('file-name').textContent = fileName ? `File: ${fileName}` : '';
});
</script>
@endsection
