<?php

namespace App\Http\Controllers;

use App\Models\AgendaRapat;
use App\Models\JanjiTemu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/berandaAdmin');
        }

        return back()->withErrors([
            'email' => 'Email atau Kata Sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function beranda()
    {
        $agendaRapat = AgendaRapat::where('status', 'terjadwal')
            ->whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->latest()
            ->take(5)
            ->get();
        $totalAgendas = AgendaRapat::where('status', 'terjadwal')
            ->whereDate('tanggal', '>=', Carbon::today())
            ->count();

        // janji temu terbaru
        $janjiTemus = JanjiTemu::whereDate('tanggal_temu', '>=', Carbon::today())
            ->orderBy('tanggal_temu', 'asc')
            ->take(5)
            ->get();
        $totalJanjiTemus = JanjiTemu::whereDate('tanggal_temu', '>=', Carbon::today())
            ->count();

        return view('admin.berandaAdmin.index', compact(
            'agendaRapat',
            'totalAgendas',
            'janjiTemus',
            'totalJanjiTemus'
        ));
    }
    public function agendaRapat()
    {
        return view('admin.rapatAdmin.index');
    }
    public function janjiTemu()
    {
        return view('admin.temuAdmin.index');
    }
    public function pengguna()
    {
        return view('admin.penggunaAdmin.index');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
