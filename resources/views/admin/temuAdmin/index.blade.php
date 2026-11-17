@extends('admin.layoutAdmin.app')

@section('title', 'Janji Temu')
@section('page-title', 'Janji Temu')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <div class=" bg-white/90 border border-black/5 p-6 rounded-lg shadow-lg">

            <div class="flex items-center text-center mb-2">
                <hr class="flex-grow border-gray-600">
                <h2 class="px-4 text-xl font-semibold text-black">Janji Temu</h2>
                <hr class="flex-grow border-gray-600">
            </div>

            {{-- FORM FILTER DAN PENCARIAN --}}
            <div id="filter-container" class="mb-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <div class="flex items-center space-x-2">
                        <button type="button" class="filter-btn px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-filter="today">Hari Ini</button>
                        <button type="button" class="filter-btn px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-filter="week">Minggu Ini</button>
                        <button type="button" class="filter-btn px-3 py-1 text-sm rounded-full cursor-pointer"
                            data-filter="month">Bulan Ini</button>
                    </div>
                    <input type="date" id="tanggal-input" value="{{ request('tanggal') }}"
                        class="filter-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm cursor-pointer">
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
                @include('admin.partials._janjiTemuTable', ['janjiTemus' => $janjiTemus])
            </div>
        </div>
    </div>
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
            const searchInput = document.getElementById('search-input');
            const tanggalInput = document.getElementById('tanggal-input');
            const filterBtns = document.querySelectorAll('.filter-btn');
            let debounceTimer;
            let currentFilter = new URLSearchParams(window.location.search).get('filter') || 'all';

            function updateFilterButtons() {
                filterBtns.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white', 'bg-gray-200', 'text-gray-700');
                    if (btn.dataset.filter === currentFilter) {
                        btn.classList.add('bg-blue-600', 'text-white');
                    } else {
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    }
                });
            }

            async function fetchData(page = 1) {
                const filterValue = currentFilter === 'all' ? '' : currentFilter;
                const search = searchInput.value;
                const tanggal = tanggalInput.value;
                const url =
                    `{{ route('temuAdmin.fetch') }}?page=${page}&search=${search}&filter=${filterValue}&tanggal=${tanggal}`;

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const data = await response.json();
                    tableWrapper.innerHTML = data.table_html;
                    document.getElementById('pagination-wrapper').innerHTML = data.pagination;
                    addPaginationListener();
                    initFlowbite();
                    updateUrl();
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }

            function updateUrl() {
                const params = new URLSearchParams();
                if (searchInput.value) params.set('search', searchInput.value);
                if (currentFilter !== 'all') params.set('filter', currentFilter);
                if (tanggalInput.value) params.set('tanggal', tanggalInput.value);
                history.pushState(null, '', `?${params.toString()}`);
            }

            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => fetchData(), 500);
            });

            tanggalInput.addEventListener('change', () => {
                currentFilter = 'all';
                updateFilterButtons();
                fetchData();
            });


            filterBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const clickedFilter = btn.dataset.filter;
                    currentFilter = (currentFilter === clickedFilter) ? 'all' : clickedFilter;
                    tanggalInput.value = '';
                    updateFilterButtons();
                    fetchData();
                });
            });

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
