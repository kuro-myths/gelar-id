<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaKelas extends Model
{
    protected $table = 'peserta_kelas';

    protected $fillable = [
        'kelas_id', 'pengguna_id', 'status', 'kemajuan',
        'bergabung_pada', 'selesai_pada',
    ];

    protected function casts(): array
    {
        return [
            'bergabung_pada' => 'datetime',
            'selesai_pada'   => 'datetime',
        ];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
