<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TemuUserController extends Controller
{
    private function applyFilters(Request $request): Builder
    {
        $query = JanjiTemu::query();
        $query->when($request->search, function ($q, $search) {
            return $q->where(function ($subQuery) use ($search) {
                $subQuery->where('nama_pemohon', 'like', "%{$search}%")
                    ->orWhere('nama_pegawai', 'like', "%{$search}%");
            });
        });
        $query->when($request->filter, function ($q, $filter) {
            if ($filter == 'today') return $q->whereDate('tanggal_temu', Carbon::today());
            if ($filter == 'week') return $q->whereBetween('tanggal_temu', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            if ($filter == 'month') return $q->whereMonth('tanggal_temu', Carbon::now()->month)->whereYear('tanggal_temu', Carbon::now()->year);
        });
        $query->when($request->tanggal, function ($q, $tanggal) {
            return $q->whereDate('tanggal_temu', $tanggal);
        });
        return $query;
    }

    public function index(Request $request)
    {
        $query = $this->applyFilters($request);
        $janjiTemus = $query->latest()->paginate(15);
        return view('admin.temuAdmin.index', compact('janjiTemus'));
    }

    public function fetchDataAdmin(Request $request)
    {
        $query = $this->applyFilters($request);
        $janjiTemus = $query->latest()->paginate(15);
        return response()->json([
            'table_html' => view('admin.partials._janjiTemuTable', compact('janjiTemus'))->render(),
            'pagination' => (string) $janjiTemus->links(),
        ]);
    }

    // --- AKSI UNTUK PUBLIK ---
    public function create(Request $request)
    {
        // Apply filters from the request
        $query = $this->applyFilters($request);
        $janjiTemus = $query->latest()->paginate(10);

        return view('user.temuUser.index', compact('janjiTemus'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemohon' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:200',
            'tanggal_temu' => 'required|date|after_or_equal:today',
            'nama_pegawai' => 'required|string|max:100',
            'jabatan_pegawai' => 'required|string|max:100',
            'tujuan' => 'required|string|max:200',
        ]);

        JanjiTemu::create($validatedData);

        return back()->with('success', 'Permintaan janji temu Anda telah berhasil dikirim.');
    }
    public function destroy(JanjiTemu $janjiTemu)
    {
        $janjiTemu->delete();
        return back()->with('success', 'Data janji temu berhasil dihapus.');
    }

    public function fetchData(Request $request)
    {
        $query = $this->applyFilters($request);
        $janjiTemus = $query->latest()->paginate(10);
        return response()->json([
            'table_html' => view('user.partials._janjiTemuTable', compact('janjiTemus'))->render(),
            'pagination' => (string) $janjiTemus->links(),
        ]);
    }
}
