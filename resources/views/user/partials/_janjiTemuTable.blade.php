<x-table>
    <x-slot:head>
        <th class="px-2 py-2">#</th>
        <th class="px-6 py-2">Pemohon</th>
        <th class="py-2">Tanggal</th>
        <th class="py-2">Bertemu Dengan</th>
    </x-slot:head>
    @forelse ($janjiTemus as $janji)
        <tr class="border-b">
            <td class="px-2 py-3">
                @if ($janjiTemus instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ ($janjiTemus->currentPage() - 1) * $janjiTemus->perPage() + $loop->iteration }}
                @else
                    {{ $loop->iteration }}
                @endif
            </td>
            <td class="px-6 py-3 font-medium">{{ Str::limit($janji->nama_pemohon, 50) }}</td>
            <td class="py-3 text-gray-600">{{ \Carbon\Carbon::parse($janji->tanggal_temu)->format('d/m/y') }}
            </td>
            <td class="py-3 text-gray-600">{{ Str::limit($janji->nama_pegawai, 20) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center py-6 text-gray-500">
                Tidak ada data janji temu yang cocok dengan filter.
            </td>
        </tr>
    @endforelse
</x-table>
<div class="mt-4" id="pagination-wrapper">
    {{ $janjiTemus->links() }}
</div>
