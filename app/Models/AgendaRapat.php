<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgendaRapat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_rapat',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'pembicara',
        'status',
        'materi',
    ];

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }
}
