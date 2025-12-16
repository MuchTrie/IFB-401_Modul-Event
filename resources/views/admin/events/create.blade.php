<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Event Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('admin.events.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Kelola Event
                        </a>
                    </div>

                    @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Kegiatan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_kegiatan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama kegiatan" value="{{ old('nama_kegiatan') }}">
                                @error('nama_kegiatan')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>

                            <!-- Jenis Kegiatan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kegiatan</label>
                                <input type="text" name="jenis_kegiatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Misal: Kajian, Pengajian, Event, dll" value="{{ old('jenis_kegiatan') }}">
                                @error('jenis_kegiatan')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                                <input type="text" name="lokasi" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan lokasi" value="{{ old('lokasi') }}">
                                @error('lokasi')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>

                            <!-- Waktu Mulai -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Mulai <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="start_at" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('start_at') }}">
                                @error('start_at')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>

                            <!-- Waktu Selesai -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Selesai <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="end_at" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('end_at') }}">
                                @error('end_at')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>

                            <!-- Kuota -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kuota (Opsional)</label>
                                <input type="number" name="kuota" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan kuota peserta" min="0" value="{{ old('kuota') }}">
                                @error('kuota')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ada batasan kuota</p>
                            </div>
                        </div>

                        <!-- Rule -->
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ketentuan / Rule (Opsional)</label>
                            <textarea name="rule" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Masukkan ketentuan event (jika ada)...">{{ old('rule') }}</textarea>
                            @error('rule')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi (Opsional)</label>
                            <textarea name="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Tulis deskripsi lengkap event...">{{ old('description') }}</textarea>
                            @error('description')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>

                        <!-- Poster -->
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar/Poster (Opsional)</label>
                            <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition">
                                <input type="file" name="poster" accept="image/*" class="hidden" id="file-upload">
                                <label for="file-upload" class="cursor-pointer">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="text-gray-600">Klik untuk upload atau drag & drop</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF (Max. 2MB)</p>
                                </label>
                                <p class="text-xs text-gray-500 mt-4" id="file-name"></p>
                            </div>
                            @error('poster')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <!-- Info Note -->
                        <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Event yang dibuat oleh Admin akan langsung <strong>terpublikasi</strong> tanpa perlu persetujuan DKM.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 mt-8">
                            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Event
                            </button>
                            <a href="{{ route('admin.events.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 rounded-lg transition text-center">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fileUpload = document.getElementById('file-upload');
        const fileName = document.getElementById('file-name');
        
        fileUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileName.textContent = 'File: ' + this.files[0].name;
            }
        });
    </script>
</x-app-layout>
