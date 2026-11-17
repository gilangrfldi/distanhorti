<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AgendaRapat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function create(AgendaRapat $agendaRapat)
    {
        $absensis = $agendaRapat->absensis()->latest()->get();
        $tanggalRapat = Carbon::parse($agendaRapat->tanggal);
        if (!$tanggalRapat->isToday()) {
            return view('user.absensiUser.index', [
                'agendaRapat' => $agendaRapat,
                'absensis' => $absensis,
                'statusAbsen' => 'ditutup',
                'pesan' => 'Absensi untuk rapat ini hanya dibuka pada tanggal ' . $tanggalRapat->format('d F Y') . '.',
            ]);
        }
        return view('user.absensiUser.index', [
            'agendaRapat' => $agendaRapat,
            'absensis' => $absensis,
            'statusAbsen' => 'dibuka',
            'pesan' => null,
        ]);
    }

    public function store(Request $request, AgendaRapat $agendaRapat)
    {
        if (!Carbon::parse($agendaRapat->tanggal)->isToday()) {
            return back()->with('error', 'Absensi hanya dapat diisi pada hari pelaksanaan rapat.');
        }
        $data = $request->validate([
            'nama_peserta' => 'required|string|max:100',
            'jabatan'      => 'required|string|max:100',
            'instansi'     => 'required|string|max:100',
            'tanda_tangan' => 'required|string',
        ]);

        $imageBase64 = $data['tanda_tangan'];
        if (strpos($imageBase64, ';base64,') === false) {
            return back()->with('error', 'Format data tanda tangan tidak valid.');
        }
        list(, $imageBase64) = explode(',', $imageBase64);
        $imageData = base64_decode($imageBase64);

        $filename = 'tanda_tangan_' . time() . '_' . uniqid() . '.png';
        $path = 'tanda_tangan/' . $filename;

        Storage::disk('public')->put($path, $imageData);
        $data['tanda_tangan'] = $filename;
        $agendaRapat->absensis()->create($data);
        return back()->with('success', 'Terima kasih, absensi Anda telah berhasil dicatat.');
    }

    public function destroy(Absensi $absensi)
    {
        if ($absensi->tanda_tangan) {
            Storage::disk('public')->delete('tanda_tangan/' . $absensi->tanda_tangan);
        }
        $absensi->delete();
        return back()->with('success', 'Data absensi berhasil dihapus.');
    }
}
