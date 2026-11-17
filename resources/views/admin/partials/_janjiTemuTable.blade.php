<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs font-bold text-white uppercase bg-green">
            <th scope="col" class="px-4 py-3"">#</th>
            <th scope="col" class="px-4 py-3"">Pemohon</th>
            <th scope="col" class="px-4 py-3"">Tanggal</th>
            <th scope="col" class="px-4 py-3"">Tujuan</th>
            <th scope="col" class="px-4 py-3"">Bertemu Dengan</th>
            <th scope="col" class="px-4 py-3"">Jabatan</th>
            <th scope="col" class="px-4 py-3" text-center">Aksi</th>
        </thead>

        @forelse ($janjiTemus as $janjiTemu)
            <tr class="border-t border-gray-200 hover:bg-gray-50">
                <th class="px-4 py-4 text-sm text-gray-700">
                    {{ $janjiTemus instanceof \Illuminate\Pagination\LengthAwarePaginator ? ($janjiTemus->currentPage() - 1) * $janjiTemus->perPage() + $loop->iteration : $loop->iteration }}
                </th>
                <th scope="row" class="flex items-center px-4 py-4 whitespace-nowrap">
                    <div class="ps-3">
                        <div class="text-base font-semibold">{{ $janjiTemu->nama_pemohon }}</div>
                        <div class="text-xs font-normal text-gray-500">{{ $janjiTemu->no_telp }}</div>
                    </div>
                </th>
                <td class="px-4 py-4">{{ \Carbon\Carbon::parse($janjiTemu->tanggal_temu)->format('d/m/Y') }}</td>
                <td class="px-4 py-4 text-sm  truncate" style="max-width: 200px;">
                    {{ Str::limit($janjiTemu->tujuan, 30) }}
                </td>
                <td class="px-4 py-4 text-base font-semibold">{{ $janjiTemu->nama_pegawai }}</td>
                <td class="px-4 py-4 text-sm ">{{ $janjiTemu->jabatan_pegawai }}</td>
                <td class="px-4 py-4">
                    <div class="flex items-center space-x-4">
                        <x-tombol-edit :modalTarget="'detail-temu-modal-' . $janjiTemu->id"
                            class="text-green-500 hover:text-green-700">Detail</x-tombol-edit>
                        <x-tombol-hapus :action="route('temuAdmin.destroy', $janjiTemu->id)">Hapus</x-tombol-hapus>
                    </div>
                </td>
            </tr>

            <x-modal :id="'detail-temu-modal-' . $janjiTemu->id" :title="'Detail Janji Temu'">
                <div class="bg-[#FDFBF5] p-6 rounded-lg border-2 border-stone-400 font-serif">
                    <div class="text-center pb-4">
                        <h4 class="font-semibold tracking-widest text-stone-700 text-sm">JANJI TEMU</h4>
                    </div>
                    {{-- BAGIAN DETAIL --}}
                    <div class="grid grid-cols-2 gap-x-8 gap-y-4 pt-4 border-t border-stone-300">
                        {{-- Nama Pemohon --}}
                        <div class="col-span-1">
                            <p class="text-xs uppercase tracking-wider text-stone-600">Nama Pemohon:</p>
                            <p class="text-md font-semibold text-stone-800 border-b border-stone-300 pb-1">
                                {{ $janjiTemu->nama_pemohon }}</p>
                        </div>
                        {{-- No Telepon --}}
                        <div class="col-span-1">
                            <p class="text-xs uppercase tracking-wider text-stone-600">No. Telepon:</p>
                            <p class="text-md font-semibold text-stone-800 border-b border-stone-300 pb-1">
                                {{ $janjiTemu->no_telp }}</p>
                        </div>
                        {{-- Tanggal --}}
                        <div class="col-span-1">
                            <p class="text-xs uppercase tracking-wider text-stone-600">Tanggal:</p>
                            <p class="text-md font-semibold text-stone-800 border-b border-stone-300 pb-1">
                                {{ \Carbon\Carbon::parse($janjiTemu->tanggal_temu)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        {{-- Alamat --}}
                        <div class="col-span-1">
                            <p class="text-xs uppercase tracking-wider text-stone-600">Alamat Pemohon:</p>
                            <p class="text-md font-semibold text-stone-800 border-b border-stone-300 pb-1"
                                title="{{ $janjiTemu->alamat }}">{{ $janjiTemu->alamat }}</p>
                        </div>
                        {{-- Tujuan --}}
                        <div class="col-span-2">
                            <p class="text-xs uppercase tracking-wider text-stone-600">Tujuan Pertemuan:</p>
                            <p class="text-md font-semibold text-stone-800 border-b border-stone-300 pb-1">
                                {{ $janjiTemu->tujuan }}</p>
                        </div>
                    </div>
                </div>
            </x-modal>

        @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-gray-500">Belum ada data janji temu.</td>
            </tr>
        @endforelse
    </table>

    <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center">
        <div id="pagination-wrapper">
            @if (isset($janjiTemus) && $janjiTemus instanceof \Illuminate\Pagination\LengthAwarePaginator && $janjiTemus->hasPages())
                <div class="mt-4">
                    {{ $janjiTemus->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
