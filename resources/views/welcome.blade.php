<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Masjid Al-Nassr</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="text-xl font-bold text-gray-900">APLIKASI MODUL EVENT</span>
                    </div>
                    <div>
                        <a href="{{ route('login') }}" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg font-medium transition">
                            LOGIN
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-4 py-12">
            <div class="max-w-5xl w-full">
                <!-- Hero Section with improved spacing -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-12 md:p-16 mb-10">
                    <div class="text-center mb-12">
                        <div class="inline-block mb-8">
                            <svg class="w-20 h-20 text-indigo-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">Selamat Datang di Masjid Al-Nassr</h1>
                        <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            Pusat kegiatan keagamaan dan kemasyarakatan. Bergabunglah dengan berbagai event dan kegiatan rutin kami untuk mempererat ukhuwah islamiyah.
                        </p>
                    </div>

                    <!-- CTA Buttons with better spacing -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center mb-10">
                        <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center px-10 py-4 bg-white hover:bg-gray-50 text-gray-800 font-semibold rounded-xl shadow-lg border-2 border-gray-300 transform transition hover:scale-105">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Lihat Jadwal Event
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg transform transition hover:scale-105">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login untuk Daftar Event
                        </a>
                    </div>
                </div>

                <!-- Features Section with improved spacing -->
                <div class="bg-white rounded-3xl shadow-xl p-10 md:p-12 mb-10">
                    <div class="text-center mb-10">
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</h3>
                        <p class="text-gray-600 text-lg">
                            Assalamu'alaikum Warahmatullahi Wabarakatuh
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8 mb-8">
                        <div class="text-center p-8 bg-blue-50 rounded-2xl hover:shadow-lg transition-shadow">
                            <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h4 class="font-bold text-xl text-gray-800 mb-3">Kelola Event</h4>
                            <p class="text-gray-600 leading-relaxed">Manajemen event dan kegiatan masjid dengan sistem terpadu</p>
                        </div>

                        <div class="text-center p-8 bg-green-50 rounded-2xl hover:shadow-lg transition-shadow">
                            <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-bold text-xl text-gray-800 mb-3">Jemaah</h4>
                            <p class="text-gray-600 leading-relaxed">Pendaftaran dan partisipasi event dengan mudah</p>
                        </div>

                        <div class="text-center p-8 bg-purple-50 rounded-2xl hover:shadow-lg transition-shadow">
                            <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h4 class="font-bold text-xl text-gray-800 mb-3">Administrasi</h4>
                            <p class="text-gray-600 leading-relaxed">Pengelolaan data dan laporan secara efisien</p>
                        </div>
                    </div>

                    <!-- Additional CTA -->
                    <div class="text-center pt-6 border-t border-gray-200">
                        <p class="text-gray-700 mb-4 text-lg">Belum memiliki akun?</p>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-white hover:bg-gray-50 text-indigo-600 font-semibold rounded-lg shadow-lg border-2 border-indigo-600 transform transition hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Daftar Akun Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    <!-- About -->
                    <div>
                        <h4 class="font-bold text-lg text-gray-800 mb-4">Tentang Kami</h4>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            Masjid Al-Nassr adalah pusat kegiatan keagamaan dan kemasyarakatan yang melayani masyarakat dengan berbagai program dan event islami.
                        </p>
                        <div class="flex items-center gap-2 text-gray-600 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Jl. Masjid Al-Nassr, Indonesia</span>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-bold text-lg text-gray-800 mb-4">Menu Cepat</h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('events.index') }}" class="text-gray-600 hover:text-indigo-600 text-sm flex items-center gap-2 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Kalender Event
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 text-sm flex items-center gap-2 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-indigo-600 text-sm flex items-center gap-2 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Daftar Akun
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="font-bold text-lg text-gray-800 mb-4">Kontak</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-2 text-gray-600 text-sm">
                                <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>info@alnassr.com</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-600 text-sm">
                                <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>(021) 1234-5678</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-600 text-sm">
                                <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Senin - Jumat: 08:00 - 17:00</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="pt-8 border-t border-gray-200 text-center">
                    <p class="text-gray-700 font-medium mb-2">© {{ date('Y') }} Masjid Al-Nassr. All rights reserved.</p>
                    <p class="text-sm text-gray-600">Sistem Manajemen Kegiatan Masjid - Dibuat dengan ❤️ untuk kemudahan umat</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
