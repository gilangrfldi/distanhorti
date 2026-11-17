@props(['agendas', 'showActions' => true])

<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs font-bold text-white uppercase bg-green">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Nama Rapat</th>
                <th scope="col" class="px-6 py-3">Lokasi</th>
                <th scope="col" class="px-6 py-3">Pembicara</th>
                <th scope="col" class="px-6 py-3">Tanggal</th>
                <th scope="col" class="px-6 py-3">Waktu</th>
                <th scope="col" class="px-6 py-3">Status</th>
                @if ($showActions)
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($agendaRapat as $agenda)
                <tr class="border-gray-200 border-t hover:bg-gray-50">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $agendaRapat instanceof \Illuminate\Pagination\LengthAwarePaginator ? ($agendaRapat->currentPage() - 1) * $agendaRapat->perPage() + $loop->iteration : $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $agenda->nama_rapat }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $agenda->lokasi }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $agenda->pembicara }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') }}
                    </td>


                    <td class="px-6 py-4">
                        @if ($agenda->status == 'selesai')
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Selesai</span>
                        @elseif ($agenda->status == 'dibatalkan')
                            <span
                                class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Dibatalkan</span>
                        @else
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Terjadwal</span>
                        @endif
                    </td>
                    @if ($showActions)
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-4">
                                @if ($agenda->materi)
                                    <a href="{{ $agenda->materi }}" target="_blank"
                                        class="font-medium text-green-600 hover:text-green-500 hover:underline transition-colors duration-300 ease-in-out">Materi</a>
                                @else
                                    <span class="font-medium text-gray-400 cursor-not-allowed">Materi</span>
                                @endif
                                <a href="{{ route('rapatAdmin.absensi', $agenda) }}"
                                    class="font-medium text-blue-600 hover:text-blue-500 hover:underline transition-colors duration-300 ease-in-out">Absensi</a>
                                <x-tombol-edit :modalTarget="'edit-agenda-modal-' . $agenda->id">
                                    Edit
                                </x-tombol-edit>
                                <x-tombol-hapus :action="route('admin.rapatAdmin.destroy', $agenda->id)">
                                    Hapus
                                </x-tombol-hapus>
                            </div>
                        </td>
                    @endif
                </tr>
                <x-modal :id="'edit-agenda-modal-' . $agenda->id" :title="'Edit Agenda: ' . $agenda->nama_rapat">
                    <form action="{{ route('admin.rapatAdmin.update', $agenda->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-[#FDFBF5] p-4 rounded-lg border-2 border-stone-400 font-serif">
                            <div class="grid grid-cols-2 gap-6">
                                {{-- Nama Rapat --}}
                                <div class="col-span-2">
                                    <label for="nama_rapat-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Nama Rapat</label>
                                    <input type="text" name="nama_rapat" id="nama_rapat-{{ $agenda->id }}"
                                        value="{{ old('nama_rapat', $agenda->nama_rapat) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                        required>
                                </div>

                                {{-- Tanggal --}}
                                <div class="col-span-1">
                                    <label for="tanggal-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal-{{ $agenda->id }}"
                                        value="{{ old('tanggal', $agenda->tanggal) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                        required>
                                </div>

                                {{-- Waktu Mulai --}}
                                <div class="col-span-1">
                                    <label for="waktu_mulai-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Waktu Mulai</label>
                                    <input type="time" name="waktu_mulai" id="waktu_mulai"
                                        value="{{ old('waktu_mulai', \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i')) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                        required>

                                </div>

                                {{-- Waktu Selesai --}}
                                <div class="col-span-1">
                                    <label for="waktu_selesai-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Waktu Selesai</label>
                                    <input type="time" name="waktu_selesai" id="waktu_selesai-{{ $agenda->id }}"
                                        value="{{ old('waktu_selesai', \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i')) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                        required>
                                </div>

                                {{-- Lokasi --}}
                                <div class="col-span-1">
                                    <label for="lokasi-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi-{{ $agenda->id }}"
                                        value="{{ old('lokasi', $agenda->lokasi) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                        required>
                                </div>

                                {{-- Pembicara --}}
                                <div class="col-span-1">
                                    <label for="pembicara-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Pembicara</label>
                                    <input type="text" name="pembicara" id="pembicara-{{ $agenda->id }}"
                                        value="{{ old('pembicara', $agenda->pembicara) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5 truncate"
                                        required>
                                </div>

                                {{-- Status --}}
                                <div class="col-span-1">
                                    <label for="status-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                    <select name="status" id="status-{{ $agenda->id }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5">
                                        {{-- Menggunakan @selected untuk memilih opsi yang sesuai dengan data saat ini --}}
                                        <option value="terjadwal" @selected($agenda->status == 'terjadwal')>Terjadwal</option>
                                        <option value="dibatalkan" @selected($agenda->status == 'dibatalkan')>Dibatalkan</option>
                                        <option value="selesai" @selected($agenda->status == 'selesai')>Selesai</option>
                                    </select>
                                </div>

                                {{-- Materi --}}
                                <div class="col-span-2">
                                    <label for="materi-{{ $agenda->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900">Link Materi (Google Drive,
                                        dll.)</label>
                                    <input type="url" name="materi" id="materi-{{ $agenda->id }}"
                                        value="{{ old('materi', $agenda->materi) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm block w-full p-2.5"
                                        placeholder="https:// ...">
                                </div>
                            </div>

                            <x-modal-footer>
                                <div class="flex justify-end ">
                                    <x-tombol-simpan>Simpan Perubahan</x-tombol-simpan>
                                </div>
                            </x-modal-footer>
                        </div>
                    </form>
                </x-modal>
            @empty
                <tr>
                    <td colspan="{{ $showActions ? '8' : '7' }}" class="text-center py-4">Belum ada data agenda
                        rapat.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4 flex justify-between items-center">
        <div id="pagination-wrapper">
            @if (isset($agendaRapat) &&
                    $agendaRapat instanceof \Illuminate\Pagination\LengthAwarePaginator &&
                    $agendaRapat->hasPages())
                <div class="mt-4">
                    {{ $agendaRapat->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
