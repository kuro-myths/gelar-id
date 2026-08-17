<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat';

    protected $fillable = [
        'pendaftaran_id', 'pengguna_id', 'jenis_gelar_id', 'nomor_sertifikat',
        'nama_tercetak', 'tanggal_terbit', 'jalur_berkas', 'kode_verifikasi', 'valid',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
            'valid'          => 'boolean',
        ];
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function jenisGelar()
    {
        return $this->belongsTo(JenisGelar::class, 'jenis_gelar_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($s) {
            $s->nomor_sertifikat = 'SERT-' . date('Y') . '-' . strtoupper(uniqid());
            $s->kode_verifikasi  = strtoupper(bin2hex(random_bytes(8)));
        });
    }
}
