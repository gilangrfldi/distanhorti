@extends('admin.layoutAdmin.app')
@section('title', 'Kelola Jadwal')
@section('page-title', 'Kelola Jadwal Rapat')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <div class="bg-white/90 border border-black/5 p-4 rounded-lg shadow-lg">
            <div class="flex items-center text-center mb-2">
                <hr class="flex-grow border-gray-600">
                <h2 class="px-4 text-xl font-bold text-black">Agenda Rapat</h2>
                <hr class="flex-grow border-gray-600">
            </div>
            <div class="flex justify-end mb-4">
                <button type="button" data-modal-target="tambah-agenda-modal" data-modal-show="tambah-agenda-modal"
                    class="font-semibold py-2 px-4 rounded-lg flex items-center space-x-2 text-white bg-green/80 hover:bg-green cursor-pointer transition-all duration-300 ease-in-out">
                    <x-icon>add</x-icon>
                    <span class="whitespace-nowrap">Tambah Agenda</span>
                </button>
            </div>

            {{-- FORM FILTER DAN PENCARIAN --}}
            <div id="filter-container" class="mb-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <div class="flex items-center space-x-2">
                        <button type="button" class="filter-btn-time px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-filter="today">Hari Ini</button>
                        <button type="button" class="filter-btn-time px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-filter="week">Minggu Ini</button>
                        <button type="button" class="filter-btn-time px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-filter="month">Bulan Ini</button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="filter-btn-status px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-status="terjadwal">Terjadwal</button>
                        <button type="button" class="filter-btn-status px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-status="selesai">Selesai</button>
                        <button type="button" class="filter-btn-status px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-status="dibatalkan">Dibatalkan</button>
                        <input type="date" id="tanggal-input" value="{{ request('tanggal') }}"
                            class="filter-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm cursor-pointer">
                    </div>
                </div>
                <div class="relative">
                    <input type="text" id="search-input" value="{{ request('search') }}"
                        placeholder="Ketik untuk mencari"
                        class="filter-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 pl-10">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-icon>search</x-icon>
                    </div>
                </div>
            </div>
            <div id="table-wrapper">
                @include('admin.partials._agendaTable', ['agendaRapat' => $agendaRapat])
            </div>
        </div>
    </div>
    <x-modal id="tambah-agenda-modal" title="Tambah Agenda Rapat Baru">
        <form action="{{ route('admin.rapatAdmin.store') }}" method="POST">
            @csrf
            <div class="bg-[#FDFBF5] p-4 rounded-lg border-2 border-stone-400 font-serif">
                <div class="grid grid-cols-2 gap-6">
                    {{-- Nama Rapat --}}
                    <div class="col-span-2">
                        <label for="nama_rapat" class="block mb-2 text-sm font-medium text-gray-900">Nama Rapat</label>
                        <input type="text" name="nama_rapat" id="nama_rapat" value="{{ old('nama_rapat') }}"
                            placeholder="Masukkan nama rapat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                            required>
                    </div>
                    {{-- Tanggal --}}
                    <div class="col-span-1">
                        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal"
                            value="{{ old('tanggal') ? old('tanggal') : date('Y-m-d') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                            required>
                    </div>
                    {{-- Lokasi --}}
                    <div class="col-span-1">
                        <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                            placeholder="Masukkan lokasi (ruangan)"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                            required>
                    </div>
                    <div class="col-span-1">
                        <label for="waktu_mulai" class="block mb-2 text-sm font-medium text-gray-900">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                            required>
                    </div>
                    <div class="col-span-1">
                        <label for="waktu_selesai" class="block mb-2 text-sm font-medium text-gray-900">Waktu
                            Selesai</label>
                        <input type="time" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                            required>
                    </div>
                    {{-- Pembicara --}}
                    <div class="col-span-1">
                        <label for="pembicara" class="block mb-2 text-sm font-medium text-gray-900">Pembicara</label>
                        <input type="text" name="pembicara" id="pembicara" value="{{ old('pembicara') }}"
                            placeholder="Masukkan nama pembicara"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                            required>
                    </div>
                    {{-- Status --}}
                    <div class="col-span-1">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select name="status" id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5">
                            <option value="terjadwal">Terjadwal</option>
                            <option value="dibatalkan">dibatalkan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="materi" class="block mb-2 text-sm font-medium text-gray-900">Link Materi (Google
                            Drive,
                            dll.)</label>
                        <input type="url" name="materi" id="materi" value="{{ old('materi') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                            placeholder="https:// ...">
                    </div>
                </div>
                <x-modal-footer>
                    <div class="flex justify-end ">
                        <x-tombol-simpan>Simpan Agenda</x-tombol-simpan>
                    </div>
                </x-modal-footer>
            </div>
        </form>
    </x-modal>
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
            <div
                class="flex items-center w-full max-w-sm p-4 space-x-4 text-gray-600 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow-lg">
                <div class="text-green-500">
                    <x-icon class="text-3xl">check_circle</x-icon>
                </div>
                <div class="ps-4 text-md font-semibold">{{ session('success') }}</div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableWrapper = document.getElementById('table-wrapper');
            const paginationWrapper = document.getElementById('pagination-wrapper');
            const searchInput = document.getElementById('search-input');
            const tanggalInput = document.getElementById('tanggal-input');
            const filterBtns = document.querySelectorAll('.filter-btn-time');
            const statusFilterBtns = document.querySelectorAll('.filter-btn-status');
            let debounceTimer;
            let currentTimeFilter = new URLSearchParams(window.location.search).get('filter') || 'all';
            let currentStatusFilter = new URLSearchParams(window.location.search).get('status') || 'all';

            // Update filter buttons based on the current filter
            function updateFilterButtons() {
                filterBtns.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white', 'bg-gray-200', 'text-gray-700');
                    if (btn.dataset.filter === currentTimeFilter) {
                        btn.classList.add('bg-blue-600', 'text-white');
                    } else {
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    }
                });
                statusFilterBtns.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                    if (btn.dataset.status === currentStatusFilter) {
                        btn.classList.add('bg-blue-600', 'text-white');
                        btn.classList.remove('bg-gray-200', 'text-gray-700');
                    }
                });
            }

            async function fetchData(page = 1) {
                const params = new URLSearchParams({
                    page: page,
                    search: searchInput.value,
                    filter: currentTimeFilter === 'all' ? '' : currentTimeFilter,
                    status: currentStatusFilter === 'all' ? '' : currentStatusFilter,
                    tanggal: tanggalInput.value,
                }).toString();

                const url = `{{ route('agenda-rapat.fetch') }}?${params}`;

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const data = await response.json();
                    tableWrapper.innerHTML = data.table_html;
                    initFlowbite();
                    updateUrl();
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }

            // Update URL with current filter and search
            function updateUrl() {
                const params = new URLSearchParams();
                if (searchInput.value) params.set('search', searchInput.value);
                if (currentTimeFilter !== 'all') params.set('filter', currentTimeFilter);
                if (currentStatusFilter !== 'all') params.set('status', currentStatusFilter);
                if (tanggalInput.value) params.set('tanggal', tanggalInput.value);
                history.pushState(null, '', `?${params.toString()}`);
            }

            // Event listeners for search input
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => fetchData(), 500);
            });

            // Event listeners for filter buttons
            filterBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const clickedFilter = btn.dataset.filter;
                    currentTimeFilter = (currentTimeFilter === clickedFilter) ? 'all' :
                        clickedFilter;
                    tanggalInput.value = '';
                    updateFilterButtons();
                    fetchData();
                });
            });
            statusFilterBtns.forEach(btn => { // <-- EVENT LISTENER BARU
                btn.addEventListener('click', (e) => {
                    const clickedStatus = btn.dataset.status;
                    currentStatusFilter = (currentStatusFilter === clickedStatus) ? 'all' :
                        clickedStatus;
                    updateFilterButtons();
                    fetchData();
                });
            });

            // Pagination
            function addPaginationListener() {
                document.querySelectorAll('#pagination-wrapper a').forEach((pageLink) => {
                    pageLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        const pageUrl = new URL(e.target.href);
                        const page = pageUrl.searchParams.get('page');
                        fetchData(page);
                    });
                });
            }

            updateFilterButtons();
        });
    </script>
@endpush
