<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SesiBelajar extends Model
{
    use HasFactory;

    protected $table = 'sesi_belajar';

    protected $fillable = [
        'semester_id', 'pertemuan_ke', 'judul', 'deskripsi',
        'materi', 'mulai_pada', 'selesai_pada', 'durasi_menit',
        'tipe', 'aktif',
    ];

    protected function casts(): array
    {
        return [
            'mulai_pada'   => 'datetime',
            'selesai_pada' => 'datetime',
            'aktif'        => 'boolean',
        ];
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'sesi_belajar_id');
    }

    public function kuesioner()
    {
        return $this->hasMany(Kuesioner::class, 'sesi_belajar_id');
    }

    public function kemajuanAkademik()
    {
        return $this->hasMany(KemajuanAkademik::class, 'sesi_belajar_id');
    }

    public function getLabelTipeAttribute(): string
    {
        return match($this->tipe) {
            'online'   => '🎥 Online Live',
            'rekaman'  => '📹 Rekaman',
            'mandiri'  => '📖 Mandiri',
            default    => $this->tipe,
        };
    }

    public function getStatusAttribute(): string
    {
        $now = now();
        if ($now->lt($this->mulai_pada)) return 'akan_datang';
        if ($now->between($this->mulai_pada, $this->selesai_pada)) return 'berlangsung';
        return 'selesai';
    }

    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'akan_datang'  => 'Akan Datang',
            'berlangsung'  => 'Sedang Berlangsung',
            'selesai'      => 'Selesai',
            default        => '-',
        };
    }
}

