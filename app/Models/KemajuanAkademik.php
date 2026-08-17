<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KemajuanAkademik extends Model
{
    protected $table = 'kemajuan_akademik';

    protected $fillable = [
        'pendaftaran_id', 'sesi_belajar_id', 'selesai',
        'diselesaikan_pada', 'nilai', 'catatan',
    ];

    protected function casts(): array
    {
        return [
            'selesai'          => 'boolean',
            'diselesaikan_pada'=> 'datetime',
        ];
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function sesiBelajar()
    {
        return $this->belongsTo(SesiBelajar::class, 'sesi_belajar_id');
    }
}
