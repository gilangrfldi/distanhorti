@extends('user.layoutUser.app')

@section('title', 'Form Absensi Rapat')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6 px-6">
        {{-- ... Bagian header dan judul ... (Tidak perlu diubah) --}}
        <div class="flex justify-between items-center mb-6">
            <span class="flex items-center">
                <a href="{{ route('rapatUser') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-300 ease-in-out">
                    <x-icon
                        class="mr-2 text-green hover:text-green-600 transition-colors duration-300 ease-in-out">arrow_back</x-icon>
                    Kembali ke Daftar Agenda
                </a>
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-slate-900">
                Formulir Absensi <span class="text-green">Rapat</span>
            </h1>
        </div>
        <div class="bg-green text-white p-4 rounded-t-lg shadow-md mb-6 rounded-tl-[96px] rounded-br-[96px]">
            <div class="text-center">
                <h2 class="text-3xl font-semibold">{{ $agendaRapat->nama_rapat }}</h2>
                <div class="flex justify-center items-center text-md mt-6 space-x-8">
                    <div class="flex items-center">
                        <x-icon class="mr-2 text-lg">place</x-icon>
                        <span>{{ $agendaRapat->lokasi }}</span>
                    </div>
                    <div class="flex items-center">
                        <x-icon class="mr-2 text-lg">event</x-icon>
                        <span>{{ \Carbon\Carbon::parse($agendaRapat->tanggal)->format('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b border-green pb-2">Isi Daftar Hadir</h2>
                    <form id="absensi-form" action="{{ route('absensiUser.store', $agendaRapat) }}" method="POST">
                        @csrf
                        {{-- Fieldset tidak perlu, karena logic enable/disable dihandle controller --}}
                        <div class="space-y-6">
                            <div>
                                <label for="nama_peserta" class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                                <input type="text" name="nama_peserta" id="nama_peserta"
                                    placeholder="Masukkan nama lengkap" value="{{ old('nama_peserta') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-3"
                                    required>
                            </div>
                            <div>
                                <label for="jabatan" class="block mb-2 text-sm font-medium">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" placeholder="Masukkan jabatan"
                                    value="{{ old('jabatan') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-3"
                                    required>
                            </div>
                            <div>
                                <label for="instansi" class="block mb-2 text-sm font-medium">Instansi</label>
                                <input type="text" name="instansi" id="instansi" placeholder="Masukkan instansi"
                                    value="{{ old('instansi') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-3"
                                    required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium">Tanda Tangan</label>
                                <div class="relative w-full">
                                    <canvas id="signature-pad"
                                        class="border border-gray-300 w-full h-40 rounded-lg"></canvas>
                                </div>
                                <button type="button" id="clear-signature"
                                    class="text-sm text-gray-500 mt-2 hover:text-red-600">Hapus Tanda Tangan</button>

                                {{-- PERBAIKAN: Input hidden untuk menampung data base64 tanda tangan --}}
                                <input type="hidden" name="tanda_tangan" id="signature-input">
                            </div>
                        </div>
                        <div class="mt-8">
                            <button type="submit"
                                class="w-full text-white bg-green hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-3 text-center">
                                Kirim Absensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ... Kolom kanan tidak perlu diubah ... --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Peserta yang Telah Hadir
                        ({{ count($absensis) }} Orang)</h2>
                    <div class="overflow-x-auto max-h-[400px] overflow-y-auto pr-2">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs font-bold text-white uppercase bg-green">
                                <th scope="col" class="px-4 py-3">#</th>
                                <th scope="col" class="px-4 py-3">Nama Peserta</th>
                                <th scope="col" class="px-4 py-3">Jabatan</th>
                                <th scope="col" class="px-4 py-3">Instansi</th>
                                <th scope="col" class="px-4 py-3">Waktu Absen</th>
                                <th scope="col" class="px-4 py-3">Paraf</th>
                            </thead>

                            @forelse ($absensis as $absensi)
                                <tr class="border-gray-200 border-t hover:bg-gray-50">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-4 py-3">{{ $absensi->nama_peserta }}</td>
                                    <td class="px-4 py-3">{{ $absensi->jabatan }}</td>
                                    <td class="px-4 py-3">{{ $absensi->instansi }}</td>
                                    <td class="px-4 py-3">{{ $absensi->created_at->format('H:i') }} WIB</td>
                                    <td class="px-4 py-3">
                                        <img src="{{ asset('storage/tanda_tangan/' . $absensi->tanda_tangan) }}"
                                            alt="Tanda Tangan"
                                            class="h-10 w-auto bg-white border border-gray-300 rounded-md p-1">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-500">
                                        Belum ada peserta yang melakukan absensi.
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
            <p class="font-bold">Gagal!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('signature-pad');

            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }

            window.addEventListener("resize", resizeCanvas);
            resizeCanvas();
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });

            document.getElementById('clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });

            // Fungsi saat form di-submit
            document.getElementById('absensi-form').addEventListener('submit', function(event) {
                if (signaturePad.isEmpty()) {
                    alert("Silakan bubuhkan tanda tangan Anda terlebih dahulu.");
                    event.preventDefault(); // Mencegah form dikirim
                } else {
                    // Ambil data tanda tangan dalam format PNG base64
                    const dataURL = signaturePad.toDataURL('image/png');
                    // Masukkan data ke input hidden
                    document.getElementById('signature-input').value = dataURL;
                }
            });
        });
    </script>
@endpush
