@extends('layouts.app')

@section('title', 'Tambah Acara Rutinan')

@section('content')
<div class="max-w-md mx-auto bg-white min-h-screen shadow-lg">
    <!-- Header -->
    <div class="p-6 border-b">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('events.index') }}" class="p-2 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
        </div>
        <h1 class="text-xl font-bold text-center">Tambah Acara</h1>
    </div>

        <!-- Form -->
        <div class="p-6">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Nama Acara Rutinan -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Nama Acara Rutinan</label>
                    <input 
                        type="text" 
                        name="nama_acara"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800"
                        placeholder="Masukkan nama acara"
                    >
                </div>

                <!-- Pilih Hari -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Pilih Hari</label>
                    <div class="relative">
                        <select 
                            name="pilih_hari"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800 appearance-none bg-white cursor-pointer"
                        >
                            <option value="">Pilih Hari</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Waktu Mulai -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Waktu Mulai</label>
                    <input 
                        type="time" 
                        name="waktu_mulai"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800"
                    >
                </div>

                <!-- Waktu Selesai -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Waktu Selesai</label>
                    <input 
                        type="time" 
                        name="waktu_selesai"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800"
                    >
                </div>

                <!-- Batas Jamaah (Optional) -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Batas Jamaah (Opsional)</label>
                    <input 
                        type="number" 
                        name="batas_jamaah"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-gray-800"
                        placeholder="Contoh: 100"
                        min="0"
                    >
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Deskripsi</label>
                    <textarea 
                        name="deskripsi"
                        rows="5"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-gray-800 resize-none"
                        placeholder="Tulis deskripsi acara..."
                    ></textarea>
                </div>

                <!-- Gambar/Poster -->
                <div class="mb-6">
                    <label class="block text-sm font-bold mb-2">Gambar/Poster</label>
                    <div class="relative">
                        <input 
                            type="file" 
                            name="gambar"
                            accept="image/*"
                            class="hidden"
                            id="file-upload"
                        >
                        <label 
                            for="file-upload"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full cursor-pointer hover:bg-gray-50 focus:outline-none focus:border-gray-800 flex items-center justify-between"
                        >
                            <span class="text-gray-500">Upload File</span>
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                        </label>
                        <p class="text-xs text-gray-500 mt-2" id="file-name"></p>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-gray-800 text-white font-bold py-4 rounded-full hover:bg-gray-900 transition"
                >
                    Ajukan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show selected filename
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            document.getElementById('file-name').textContent = 'File: ' + fileName;
        }
    });
</script>
@endpush
