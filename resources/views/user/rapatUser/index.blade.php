@extends('user.layoutUser.app')

@section('title', 'Agenda Rapat')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-10">
            <!-- KIRI: Judul, Tabs, Daftar Agenda -->
            <section class="lg:col-span-2">
                <!-- Heading -->
                <header class="mb-6">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-slate-900">
                        Agenda Rapat <span class="text-green">DISTANHORTI</span>
                    </h1>
                    <p class="mt-2 text-sm sm:text-base text-slate-500">
                        Pantau jadwal, hadir tepat waktu, hasilkan keputusan bersama.
                    </p>
                </header>

                <!-- Tabs -->
                <nav class="flex items-center gap-3">
                    {{-- TERJADWAL --}}
                    <a href="{{ route('rapatUser', ['status' => 'terjadwal']) }}"
                        class="px-5 py-2 rounded-[12px] font-semibold transition
           {{ $currentFilter == 'terjadwal'
               ? 'bg-yellow-400 text-slate-900'
               : 'border border-yellow-400 text-slate-600 hover:bg-yellow-50' }}">
                        Terjadwal
                    </a>

                    {{-- TERLAKSANA --}}
                    <a href="{{ route('rapatUser', ['status' => 'selesai']) }}"
                        class="px-5 py-2 rounded-[12px] font-semibold transition
           {{ $currentFilter == 'selesai'
               ? 'bg-emerald-600 text-white'
               : 'border border-emerald-500 text-slate-600 hover:bg-emerald-50' }}">
                        Terlaksana
                    </a>

                    {{-- DIBATALKAN --}}
                    <a href="{{ route('rapatUser', ['status' => 'dibatalkan']) }}"
                        class="px-5 py-2 rounded-[12px] font-semibold transition
           {{ $currentFilter == 'dibatalkan'
               ? 'bg-rose-500 text-white'
               : 'border border-rose-500 text-slate-600 hover:bg-rose-50' }}">
                        Dibatalkan
                    </a>
                </nav>

                <!-- Garis aksen hijau bawah tabs -->
                <div class="mt-3 h-0.5 w-full bg-emerald-500 rounded-full"></div>

                <!-- List Agenda -->
                <div class="mt-6 lg:max-h-[72vh] lg:overflow-y-auto pr-1 lg:pr-2">
                    @forelse ($agendas as $agenda)
                        <article class="group rounded-lg transition hover:bg-emerald-50/60">
                            <div class="py-5 border-b border-slate-200">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                    <div class="min-w-0">
                                        <h3 class="text-lg font-bold text-slate-900 truncate">
                                            {{ $agenda->nama_rapat }}
                                        </h3>

                                        <div
                                            class="mt-2 grid grid-cols-1 sm:grid-cols-[240px_150px_1fr] items-center gap-x-6 gap-y-2 text-sm">
                                            <div class="flex items-center gap-1.5 text-slate-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                    fill="#10b981">
                                                    <path d="M7 2h2v2h6V2h2v2h3v18H4V4h3V2Zm13 7H4v11h16V9Z" />
                                                </svg>
                                                <span class="font-medium">
                                                    {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('l, d/m/Y') }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-slate-700">
                                                <svg data-slot="icon" fill="none" stroke-width="1.5" class="w-4 h-4"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                                </svg>
                                                <span class="truncate">
                                                    {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-slate-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                    fill="#10b981">
                                                    <path
                                                        d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5Z" />
                                                </svg>
                                                <span class="truncate">{{ $agenda->lokasi }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kanan: Aksi -->
                                    <div class="flex flex-col sm:flex-row gap-3 sm:shrink-0">
                                        @if ($agenda->materi)
                                            <a href="{{ $agenda->materi }}" target="_blank"
                                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium
                              border border-emerald-500 text-emerald-700 hover:bg-emerald-50 transition"
                                                title="Download Materi">
                                                <x-icon class="text-base">article</x-icon>
                                                <span>Download Materi</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="bg-gray-50 rounded-lg p-8 text-center">
                            <p class="text-gray-600">
                                @if ($currentFilter == 'selesai')
                                    Tidak ada agenda rapat yang telah terlaksana.
                                @elseif($currentFilter == 'dibatalkan')
                                    Tidak ada agenda rapat yang dibatalkan.
                                @else
                                    Saat ini tidak ada agenda rapat yang terjadwal.
                                @endif
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- KANAN: Widget Kalender -->
            <aside class="mt-8 lg:mt-0 lg:col-span-1">
                <div class="sticky lg:top-24 bg-gray-50 rounded-xl shadow-md overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-3">
                            <button id="prev-month-btn"
                                class="p-2 rounded-full hover:bg-green-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                <x-icon>chevron_left</x-icon>
                            </button>
                            <h3 class="text-lg font-bold" id="calendar-month-year"></h3>
                            <button id="next-month-btn" class="p-2 rounded-full hover:bg-green-200 cursor-pointer">
                                <x-icon>chevron_right</x-icon>
                            </button>
                        </div>

                        <!-- Header hari -->
                        <div class="grid grid-cols-7 gap-2 text-center text-xs sm:text-sm">
                            <div class="font-semibold text-gray-500">Min</div>
                            <div class="font-semibold text-gray-500">Sen</div>
                            <div class="font-semibold text-gray-500">Sel</div>
                            <div class="font-semibold text-gray-500">Rab</div>
                            <div class="font-semibold text-gray-500">Kam</div>
                            <div class="font-semibold text-gray-500">Jum</div>
                            <div class="font-semibold text-gray-500">Sab</div>
                        </div>

                        <!-- Tanggal -->
                        <div id="calendar-dates" class="grid grid-cols-7 gap-2 text-center text-sm mt-2"></div>

                        <hr class="my-5">
                        <div id="agenda-display"></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agendasByDate = @json($agendasByDate);
            const todayStr = '{{ $today->format('Y-m-d') }}';
            const [year, month, day] = todayStr.split('-').map(Number);
            const today = new Date(year, month - 1, day);

            const monthYearEl = document.getElementById('calendar-month-year');
            const datesEl = document.getElementById('calendar-dates');
            const agendaDisplayEl = document.getElementById('agenda-display');
            const prevMonthBtn = document.getElementById('prev-month-btn');
            const nextMonthBtn = document.getElementById('next-month-btn');

            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();
            let selectedDate = today;

            function generateCalendar(month, year) {
                datesEl.innerHTML = '';
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                monthYearEl.textContent = new Date(year, month).toLocaleDateString('id-ID', {
                    month: 'long',
                    year: 'numeric'
                });

                for (let i = 0; i < firstDay; i++) {
                    datesEl.innerHTML += `<div class="w-10 h-10"></div>`;
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(year, month, day);
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    const fullDateString = `${y}-${m}-${d}`;

                    const cell = document.createElement('div');
                    cell.className =
                        'date-cell w-10 h-10 flex items-center justify-center rounded-full cursor-pointer relative transition-colors';
                    cell.textContent = day;

                    if (agendasByDate[fullDateString]) {
                        cell.innerHTML +=
                            '<div class="absolute bottom-1 w-1.5 h-1.5 bg-green-500 rounded-full"></div>';
                    }

                    if (date.toDateString() === selectedDate.toDateString()) {
                        cell.classList.add('bg-green-600', 'text-white', 'font-bold');
                    } else if (date.toDateString() === today.toDateString()) {
                        cell.classList.add('bg-gray-200');
                    } else {
                        cell.classList.add('hover:bg-gray-100');
                    }

                    cell.addEventListener('click', () => selectDate(date));
                    datesEl.appendChild(cell);
                }
                updateNavButtons();
            }

            function displayAgendasForDate(date) {
                const y = date.getFullYear();
                const m = String(date.getMonth() + 1).padStart(2, '0');
                const d = String(date.getDate()).padStart(2, '0');
                const dateString = `${y}-${m}-${d}`;

                const agendas = agendasByDate[dateString];

                if (agendas && agendas.length > 0) {
                    let html = '<div class="space-y-4">';
                    agendas.forEach(agenda => {
                        html +=
                            `<div class="border-l-4 border-green-500 pl-4"><p class="font-bold text-gray-800">${agenda.nama_rapat}</p><p class="text-sm text-gray-600">${agenda.lokasi}</p></div>`;
                    });
                    html += '</div>';
                    agendaDisplayEl.innerHTML = html;
                } else {
                    agendaDisplayEl.innerHTML =
                        `<div class="text-center py-8"><div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center"><svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0h18M9.75 14.25h.008v.008H9.75v-.008Zm3 0h.008v.008H12.75v-.008Zm3 0h.008v.008H15.75v-.008Zm-3-3h.008v.008H12.75v-.008Zm0 6h.008v.008H12.75v-.008Zm-3-3h.008v.008H9.75v-.008Zm-3 3h.008v.008H6.75v-.008Zm6-6h.008v.008H15.75v-.008Zm-6 3h.008v.008H9.75v-.008Zm6 0h.008v.008H15.75v-.008Zm-3 3h.008v.008H12.75v-.008Z" /></svg></div><p class="mt-4 font-semibold text-gray-700">Tidak ada kegiatan/event di hari ini</p></div>`;
                }
            }

            function selectDate(date) {
                selectedDate = date;
                generateCalendar(currentMonth, currentYear);
                displayAgendasForDate(date);
            }

            function updateNavButtons() {
                const todayMonth = today.getMonth();
                const todayYear = today.getFullYear();
                prevMonthBtn.disabled = (currentYear < todayYear) || (currentYear === todayYear && currentMonth <=
                    todayMonth);
            }

            // ... (Event listeners tidak berubah) ...
            prevMonthBtn.addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentMonth, currentYear);
            });
            nextMonthBtn.addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentMonth, currentYear);
            });

            // Inisialisasi
            generateCalendar(currentMonth, currentYear);
            displayAgendasForDate(selectedDate);
        });
    </script>
@endpush
