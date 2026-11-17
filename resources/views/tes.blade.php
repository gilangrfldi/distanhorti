<?php

namespace App\Http\Controllers;

use App\Models\AgendaRapat;
use Illuminate\Http\Request;
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
            return back()->with('error', 'Masa pengisian absensi telah berakhir.');
        }

        // Validasi data form
        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'tanda_tangan' => 'required|string',
        ]);
        $imageData = $request->tanda_tangan;
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'tanda_tangan_' . time() . '.png';

        $agendaRapat->absensis()->create([
            'nama_peserta' => $request->nama_peserta,
            'jabatan' => $request->jabatan,
            'instansi' => $request->instansi,
            'tanda_tangan' => $imageName,
        ]);

        return back()->with('success', 'Terima kasih, absensi Anda telah berhasil dicatat.');
    }
}
