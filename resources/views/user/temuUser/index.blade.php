@extends('user.layoutUser.app')

@section('title', 'Form Janji Temu')

@section('content')
    <div class="max-w-7xl mx-auto space-y-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-slate-900">
            Pembuatan Janji Temu <span class="text-green">DISTANHORTI</span>
        </h1>
        <p>Pertemuan lebih tertata, pelayanan lebih maksimal</p>
        {{-- </div> --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <div class="lg:col-span-2">
                <div class="w-full mx-auto bg-white p-8 rounded-lg shadow-md">
                    <form action="{{ route('temuUser.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <h3 class="text-lg lg:text-2xl font-semibold text-gray-900 border-b border-green pb-2 mb-4">
                                    Data Diri
                                    Pemohon</h3>
                            </div>
                            <div class="md:col-span-2">
                                <label for="nama_pemohon" class="block mb-2 text-md font-medium">Nama
                                    Lengkap</label>
                                <input type="text" name="nama_pemohon" id="nama_pemohon"
                                    placeholder="Masukkan nama lengkap"
                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                    required>
                                @error('nama_pemohon')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="no_telp" class="block mb-2 text-md font-medium">No. Telepon / WhatsApp</label>
                                <input type="tel" name="no_telp" id="no_telp" placeholder="08xx-xxxx-xxxxx"
                                    inputmode="numeric" maxlength="15" oninput="formatPhoneNumber(this)"
                                    class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                    required>
                            </div>
                            <div>
                                <label for="alamat" class="block mb-2 text-md font-medium">Alamat</label>
                                <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat lengkap"
                                    maxlength="200"
                                    class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                    required>
                            </div>
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg lg:text-2xl font-semibold text-gray-900 border-b border-green pb-2 mb-4">
                                    Detail
                                    Pertemuan</h3>
                            </div>
                            <div>
                                <label for="nama_pegawai" class="block mb-2 text-md font-medium">Nama Pegawai</label>
                                <input type="text" name="nama_pegawai" id="nama_pegawai" maxlength="100"
                                    placeholder="Masukkan nama pegawai"
                                    class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                    required>
                            </div>
                            <div>
                                <label for="jabatan_pegawai" class="block mb-2 text-md font-medium">Jabatan Pegawai</label>
                                <input type="text" name="jabatan_pegawai" id="jabatan_pegawai" maxlength="100"
                                    placeholder="Masukkan jabatan pegawai"
                                    class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                    required>
                            </div>
                            <div>
                                <label for="tanggal_temu" class="block mb-2 text-md font-medium">Tanggal Pertemuan</label>
                                <input type="date" name="tanggal_temu" id="tanggal_temu"
                                    value="{{ old('tanggal') ? old('tanggal') : date('Y-m-d') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                    required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="tujuan" class="block mb-2 text-sm font-medium">Tujuan Pertemuan</label>
                                <textarea name="tujuan" id="tujuan" rows="4" placeholder="Jelaskan secara singkat tujuan pertemuan Anda"
                                    maxlength="200"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5" required></textarea>
                            </div>
                            {{-- Input Dokumen Dihapus --}}
                        </div>
                        <div class="mt-8">
                            <button type="submit"
                                class="w-full text-white bg-green hover:bg-green-400 cursor-pointer font-medium rounded-lg text-sm px-5 py-3 text-center transition-colors duration-300 ease-in-out">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-white p-8 rounded-lg shadow-md h-full flex flex-col">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Daftar Janji Temu</h2>
                    <p class="text-sm text-gray-500 mb-6">Gunakan filter di bawah ini untuk mencari janji temu.</p>

                    <div id="filter-container" class="mb-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                            <div class="flex items-center space-x-2">
                                {{-- Tombol filter sekarang tidak lagi berisi link --}}
                                <button type="button" class="filter-btn px-3 py-1 text-sm rounded-full cursor-pointer"
                                    data-filter="today">Hari Ini</button>
                                <button type="button" class="filter-btn px-3 py-1 text-sm rounded-full cursor-pointer"
                                    data-filter="week">Minggu Ini</button>
                                <button type="button" class="filter-btn px-3 py-1 text-sm rounded-full cursor-pointer"
                                    data-filter="month">Bulan Ini</button>
                            </div>
                            <input type="date" id="tanggal-input" value="{{ request('tanggal') }}"
                                class="filter-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm">
                        </div>
                        <div class="relative">
                            <input type="text" id="search-input" value="{{ request('search') }}"
                                placeholder="Ketik untuk mencari..."
                                class="filter-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 pl-10">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <x-icon>search</x-icon>
                            </div>
                        </div>
                    </div>

                    <div id="table-wrapper" class="flex-grow overflow-auto">
                        @include('user.partials._janjiTemuTable', ['janjiTemus' => $janjiTemus])
                    </div>
                </div>
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
        function formatPhoneNumber(input) {
            let phoneNumber = input.value.replace(/\D/g, '');
            if (phoneNumber.length > 8) {
                phoneNumber = phoneNumber.replace(/(\d{4})(\d{4})(\d{0,4})/, '$1-$2-$3');
            } else if (phoneNumber.length > 4) {
                phoneNumber = phoneNumber.replace(/(\d{4})(\d{0,4})/, '$1-$2');
            }
            input.value = phoneNumber;
        }

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
                    `{{ route('temuUser.fetch') }}?page=${page}&search=${search}&filter=${filterValue}&tanggal=${tanggal}`;

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
                const newUrl = `?${params.toString()}`;
                history.pushState(null, '', newUrl);
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

                    if (currentFilter === clickedFilter) {
                        currentFilter = 'all';
                    } else {
                        currentFilter = clickedFilter;
                    }

                    tanggalInput.value =
                        '';
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
