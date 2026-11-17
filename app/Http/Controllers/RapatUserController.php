<?php

namespace App\Http\Controllers;

use App\Models\AgendaRapat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RapatUserController extends Controller
{
    public function rapatUser(Request $request)
    {
        $filter = $request->query('status', 'terjadwal');
        $allowedFilters = ['terjadwal', 'selesai', 'dibatalkan'];
        if (!in_array($filter, $allowedFilters)) {
            $filter = 'terjadwal';
        }
        $query = AgendaRapat::where('status', $filter);
        if ($filter == 'terjadwal') {
            $agendas = $query->whereDate('tanggal', '>=', now())
                ->orderBy('tanggal', 'ASC')
                ->get();
        } else {
            $agendas = $query->orderBy('tanggal', 'DESC')->get();
        }
        $agendasByDate = $agendas->groupBy(function ($agenda) {
            return Carbon::parse($agenda->tanggal)->format('Y-m-d');
        });

        // Menyesuaikan view ke path yang benar sesuai dengan nama controller dan view
        return view('user.rapatUser.index', [
            'agendas' => $agendas,
            'currentFilter' => $filter,
            'agendasByDate' => $agendasByDate,
            'today' => Carbon::now()
        ]);
    }
}
