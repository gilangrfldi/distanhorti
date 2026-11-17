<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_rapat_id',
        'nama_peserta',
        'jabatan',
        'instansi',
        'tanda_tangan',
    ];

    public function agendaRapat(): BelongsTo
    {
        return $this->belongsTo(AgendaRapat::class);
    }
}
