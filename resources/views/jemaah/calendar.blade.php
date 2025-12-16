<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kalender Event
            </h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Kalender -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold mb-4 text-gray-900">Kalender</h2>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4">
                            <!-- Month/Year Selector -->
                            <div class="text-center mb-3 flex justify-between items-center gap-2">
                                <form method="GET" class="flex gap-2 w-full justify-center">
                                    <select name="month" onchange="this.form.submit()" class="bg-white border-2 border-gray-300 text-gray-900 text-sm font-semibold rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 cursor-pointer shadow-sm">
                                        @foreach($months as $num => $name)
                                            <option value="{{ $num }}" {{ $num == $currentMonth ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="year" onchange="this.form.submit()" class="bg-white border-2 border-gray-300 text-gray-900 text-sm font-semibold rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 cursor-pointer shadow-sm">
                                        @for ($y = now()->year - 5; $y <= now()->year + 5; $y++)
                                            <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>
                            </div>

                            <!-- Days Header -->
                            <div class="grid grid-cols-7 gap-1 mb-2 text-xs font-bold text-gray-700">
                                <div class="text-center py-1">M</div>
                                <div class="text-center py-1">S</div>
                                <div class="text-center py-1">S</div>
                                <div class="text-center py-1">R</div>
                                <div class="text-center py-1">K</div>
                                <div class="text-center py-1">J</div>
                                <div class="text-center py-1">S</div>
                            </div>

                            <!-- Calendar Dates -->
                            <div class="grid grid-cols-7 gap-1">
                                @for ($i = 0; $i < $startDay; $i++)
                                    <div class="aspect-square"></div>
                                @endfor

                                @for ($i = 1; $i <= $daysInMonth; $i++)
                                    @php
                                        $hasEvent = isset($eventsByDate[$i]);
                                    @endphp
                                    <button 
                                        class="aspect-square rounded-lg p-1 text-sm font-semibold transition-all duration-200
                                        {{ $today->day == $i && $today->month == $currentMonth && $today->year == $currentYear 
                                            ? 'bg-emerald-600 text-white ring-2 ring-emerald-400 shadow-lg' 
                                            : ($hasEvent 
                                                ? 'bg-green-400 text-gray-900 hover:bg-green-500 hover:shadow-md hover:scale-105' 
                                                : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200') }}"
                                        
                                        @if($hasEvent)
                                            onclick='openCalendarEvent(@json($eventsByDate[$i]))'
                                        @endif
                                    >
                                        {{ $i }}
                                    </button>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Lists -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold mb-4 text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Event Yang Akan Datang
                        </h2>
                        
                        @if($upcomingEvents->count() > 0)
                            <div class="space-y-3">
                                @foreach($upcomingEvents as $event)
                                <div class="border-l-4 border-blue-600 bg-blue-50 p-4 rounded-lg hover:shadow-md transition cursor-pointer" onclick="openDetailModal({{ $event->event_id }})">
                                    <h3 class="font-bold text-gray-900">{{ $event->nama_kegiatan }}</h3>
                                    <p class="text-sm text-gray-600">
                                        📅 {{ \Carbon\Carbon::parse($event->start_at)->format('d M Y, H:i') }}
                                    </p>
                                    <p class="text-sm text-gray-600">📍 {{ $event->lokasi }}</p>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                {{ $upcomingEvents->appends(['month' => $currentMonth, 'year' => $currentYear])->links() }}
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Tidak ada event yang akan datang</p>
                        @endif
                    </div>

                    <!-- Past Events -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold mb-4 text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Event Yang Sudah Selesai
                        </h2>
                        
                        @if($pastEvents->count() > 0)
                            <div class="space-y-3">
                                @foreach($pastEvents as $event)
                                <div class="border-l-4 border-gray-400 bg-gray-50 p-4 rounded-lg hover:shadow-md transition cursor-pointer" onclick="openDetailModal({{ $event->event_id }})">
                                    <h3 class="font-bold text-gray-900">{{ $event->nama_kegiatan }}</h3>
                                    <p class="text-sm text-gray-600">
                                        📅 {{ \Carbon\Carbon::parse($event->start_at)->format('d M Y, H:i') }}
                                    </p>
                                    <p class="text-sm text-gray-600">📍 {{ $event->lokasi }}</p>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                {{ $pastEvents->appends(['month' => $currentMonth, 'year' => $currentYear])->links() }}
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Tidak ada event sebelumnya</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Calendar Events List -->
    <div id="calendarEventModal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl p-6">
            <h2 class="text-xl font-bold mb-4">Event Pada Tanggal Ini</h2>
            <div id="calendarEventList" class="space-y-3 mb-4"></div>
            <button onclick="closeCalendarModal()" class="mt-5 w-full py-2 bg-gray-800 text-white rounded-xl">
                Tutup
            </button>
        </div>
    </div>

    <!-- Modal Detail Event -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-2xl font-bold text-gray-900">Detail Event</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-bold">&times;</button>
            </div>

            <div class="mt-4">
                <div id="modalPosterContainer" class="mb-6 hidden">
                    <img id="modalPoster" src="" alt="Event Poster" class="w-full h-96 object-cover rounded-lg">
                </div>

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

                    <div>
                        <h4 class="font-semibold text-gray-700">Kuota</h4>
                        <p id="modalKuota" class="text-gray-900"></p>
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

                <div class="mt-6 pt-4 border-t">
                    <a id="modalDetailLink" href="#" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 rounded-lg transition">
                        Lihat Detail Lengkap
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const allEvents = @json(array_merge($upcomingEvents->items(), $pastEvents->items()));

        function openCalendarEvent(events) {
            const html = events.map(ev => `
                <div class="bg-gray-100 p-3 rounded-lg hover:bg-gray-200 cursor-pointer transition" 
                    onclick='selectEventFromCalendar(${JSON.stringify(ev)})'>
                    <h4 class="font-bold text-gray-900">${ev.nama_kegiatan}</h4>
                    <p class="text-sm text-gray-600">${new Date(ev.start_at).toLocaleString('id-ID', {hour: '2-digit', minute: '2-digit'})}</p>
                    <p class="text-sm text-gray-600">${ev.lokasi || '-'}</p>
                </div>
            `).join('');
            
            document.getElementById('calendarEventList').innerHTML = html;
            document.getElementById('calendarEventModal').classList.remove('hidden');
        }

        function selectEventFromCalendar(ev) {
            closeCalendarModal();
            openDetailModal(ev.event_id);
        }

        function closeCalendarModal() {
            document.getElementById('calendarEventModal').classList.add('hidden');
        }

        function openDetailModal(eventId) {
            const event = allEvents.find(e => e.event_id === eventId);
            if (!event) return;

            document.getElementById('modalNamaKegiatan').textContent = event.nama_kegiatan;
            document.getElementById('modalJenis').textContent = event.jenis_kegiatan || 'Umum';
            document.getElementById('modalLokasi').textContent = event.lokasi || '-';
            document.getElementById('modalStartAt').textContent = new Date(event.start_at).toLocaleString('id-ID', { 
                day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' 
            });
            document.getElementById('modalEndAt').textContent = new Date(event.end_at).toLocaleString('id-ID', { 
                day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' 
            });
            document.getElementById('modalKuota').textContent = event.kuota || 'Tidak terbatas';
            document.getElementById('modalDetailLink').href = `/events/${event.event_id}`;

            if (event.poster) {
                document.getElementById('modalPoster').src = '/storage/' + event.poster;
                document.getElementById('modalPosterContainer').classList.remove('hidden');
            } else {
                document.getElementById('modalPosterContainer').classList.add('hidden');
            }

            if (event.description) {
                document.getElementById('modalDescription').textContent = event.description;
                document.getElementById('modalDescriptionContainer').classList.remove('hidden');
            } else {
                document.getElementById('modalDescriptionContainer').classList.add('hidden');
            }

            if (event.rule) {
                document.getElementById('modalRule').textContent = event.rule;
                document.getElementById('modalRuleContainer').classList.remove('hidden');
            } else {
                document.getElementById('modalRuleContainer').classList.add('hidden');
            }

            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target.id === 'detailModal') closeDetailModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
                closeCalendarModal();
            }
        });
    </script>
</x-app-layout>
