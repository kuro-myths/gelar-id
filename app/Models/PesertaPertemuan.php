<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaPertemuan extends Model
{
    protected $table = 'peserta_pertemuan';

    protected $fillable = [
        'pertemuan_id', 'pengguna_id', 'bergabung_pada',
        'keluar_pada', 'hadir', 'durasi_hadir_menit',
    ];

    protected function casts(): array
    {
        return [
            'bergabung_pada' => 'datetime',
            'keluar_pada'    => 'datetime',
            'hadir'          => 'boolean',
        ];
    }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
