@extends('admin.layoutAdmin.app')

@section('title', 'Hasil Absensi Rapat')
@section('page-title', 'Hasil Absensi: ' . $agendaRapat->nama_rapat)

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <div class="bg-white/90 border border-black/5 p-6 rounded-lg shadow-lg">

            {{-- Action Buttons (QR Code, Export to PDF, and Back) --}}
            <div class="flex justify-between mb-6 items-center">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition-all duration-300 ease-in-out py-2 px-4 rounded-md bg-gray-200 hover:bg-gray-300">
                    <x-icon class="mr-2">arrow_back</x-icon>
                    Kembali
                </a>

                <div class="space-x-4">
                    <button
                        class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition-all duration-300"
                        data-modal-target="qr-code-modal" data-modal-toggle="qr-code-modal">
                        QR Code
                    </button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-all duration-300">
                        Export to PDF
                    </button>
                </div>
            </div>

            {{-- Title and Rapat Info --}}
            <div class="flex items-center text-center mb-6">
                <hr class="flex-grow border-gray-600">
                <h2 class="px-4 text-xl font-semibold text-black">Hasil Absensi</h2>
                <hr class="flex-grow border-gray-600">
            </div>

            <div class="mb-8">
                <p class="mt-1 text-gray-500">
                    <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($agendaRapat->tanggal)->format('d F Y') }} |
                    <strong>Lokasi:</strong> {{ $agendaRapat->lokasi }}
                </p>

                {{-- Public Absence Link --}}
                <p class="mt-4 text-sm">
                    <strong>Bagikan Link Absensi:</strong>
                    <a href="{{ route('absensiUser.create', $agendaRapat) }}" target="_blank"
                        class="text-blue-600 hover:underline break-all">
                        {{ route('absensiUser.create', $agendaRapat) }}
                    </a>
                </p>
            </div>

            {{-- Absensi Table --}}
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs font-bold text-white uppercase bg-green">
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Nama Peserta</th>
                    <th scope="col" class="px-6 py-3">Jabatan</th>
                    <th scope="col" class="px-6 py-3">Instansi</th>
                    <th scope="col" class="px-6 py-3">Waktu Absen</th>
                    <th scope="col" class="px-6 py-3">Paraf</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </thead>

                @forelse ($absensis as $absensi)
                    <tr class="border-gray-200 border-t hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">{{ $absensi->nama_peserta }}</td>
                        <td class="px-6 py-4">{{ $absensi->jabatan }}</td>
                        <td class="px-6 py-4">{{ $absensi->instansi }}</td>
                        <td class="px-6 py-4">{{ $absensi->created_at->format('d/m/Y - H:i') }} WIB</td>
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/tanda_tangan/' . $absensi->tanda_tangan) }}" alt="Tanda Tangan"
                                class="h-10 w-auto bg-white border border-gray-300 rounded-md p-1">
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('absensiAdmin.destroy', $absensi->id) }}"
                                class="font-medium text-red-600 hover:text-red-500 hover:underline transition-colors duration-300 ease-in-out">
                                Hapus
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6">
                            <p class="text-gray-500">Belum ada peserta yang melakukan absensi untuk rapat ini.</p>
                        </td>
                    </tr>
                @endforelse
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $absensis->links() }}
            </div>

        </div>
    </div>

    <x-modal id="qr-code-modal" title="QR Code Absensi">
        <div class="flex justify-center flex-col items-center mb-4">
            <h1 class="font-semibold text-2xl mb-4">{{ $agendaRapat->nama_rapat }}</h1>
            <img src="{{ route('absensiUser.qr-code', $agendaRapat->id) }}" alt="QR Code untuk Absensi" class="mb-4">
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.absensi.qr-code.download', $agendaRapat->id) }}"
                class="bg-green text-white px-6 py-2 rounded-md hover:bg-green-600">
                Download QR Code
            </a>
        </div>
    </x-modal>


@endsection

@push('scripts')
@endpush
