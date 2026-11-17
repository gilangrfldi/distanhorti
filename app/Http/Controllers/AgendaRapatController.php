<?php

namespace App\Http\Controllers;

use App\Models\AgendaRapat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AgendaRapatController extends Controller
{

    private function applyFilters(Request $request): Builder
    {
        $query = AgendaRapat::query();

        // Filter berdasarkan pencarian
        $query->when($request->search, function ($q, $search) {
            return $q->where(function ($subQuery) use ($search) {
                $subQuery->where('nama_rapat', 'like', "%{$search}%")
                    ->orWhere('pembicara', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        });

        // Filter berdasarkan tanggal tertentu
        $query->when($request->tanggal, function ($q, $tanggal) {
            return $q->whereDate('tanggal', $tanggal);
        });

        // Filter berdasarkan hari ini, minggu ini, atau bulan ini
        $query->when($request->filter, function ($q, $filter) {
            if ($filter == 'today') {
                return $q->whereDate('tanggal', Carbon::today());
            }
            if ($filter == 'week') {
                return $q->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            if ($filter == 'month') {
                return $q->whereMonth('tanggal', Carbon::now()->month)->whereYear('tanggal', Carbon::now()->year);
            }
        });

        $query->when($request->status, function ($q, $status) {
            return $q->where('status', $status);
        });

        return $query;
    }


    public function fetchDataAdmin(Request $request)
    {
        $query = $this->applyFilters($request);
        // PERBAIKAN: Urutkan berdasarkan tanggal rapat
        $agendaRapat = $query->latest('tanggal')->paginate(15);
        return response()->json([
            'table_html' => view('admin.partials._agendaTable', compact('agendaRapat'))->render(),
            'pagination' => (string) $agendaRapat->links(),
        ]);
    }

    public function index(Request $request)
    {
        $query = $this->applyFilters($request);
        // PERBAIKAN: Urutkan berdasarkan tanggal rapat
        $agendaRapat = $query->latest('tanggal')->paginate(15);
        return view('admin.rapatAdmin.index', compact('agendaRapat'));
    }

    public function store(Request $request)
    {
        // PERBAIKAN: Simpan data yang sudah divalidasi
        $validatedData = $request->validate([
            'nama_rapat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
            'pembicara' => 'required|string|max:255',
            'status' => 'required|in:terjadwal,dibatalkan,selesai',
            'materi' => 'nullable|url',
        ]);

        AgendaRapat::create($validatedData);

        return redirect()->route('admin.rapatAdmin.index')
            ->with('success', 'Agenda rapat baru berhasil ditambahkan.');
    }

    public function update(Request $request, AgendaRapat $rapatAdmin)
    {
        $validatedData = $request->validate([
            'nama_rapat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
            'pembicara' => 'required|string|max:255',
            'status' => 'required|in:terjadwal,dibatalkan,selesai',
            'materi' => 'nullable|url',
        ]);

        $rapatAdmin->update($validatedData);

        return redirect()->route('admin.rapatAdmin.index')
            ->with('success', 'Agenda rapat berhasil diperbarui.');
    }

    public function destroy(AgendaRapat $rapatAdmin)
    {
        $rapatAdmin->delete();

        return redirect()->route('admin.rapatAdmin.index')
            ->with('success', 'Agenda rapat berhasil dihapus.');
    }

    public function showAbsensi(AgendaRapat $agendaRapat)
    {
        $absensis = $agendaRapat->absensis()->latest()->paginate(15);
        return view('admin.absensiAdmin.index', compact('agendaRapat', 'absensis'));
    }
}
