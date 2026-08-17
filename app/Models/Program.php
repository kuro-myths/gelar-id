<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';

    protected $fillable = [
        'jenis_gelar_id', 'nama', 'slug', 'deskripsi', 'kurikulum',
        'tujuan', 'harga', 'harga_coret', 'maks_peserta', 'gambar',
        'aktif', 'unggulan', 'urutan', 'jalur_gratis', 'syarat_gratis',
        'label_badge', 'warna_badge',
    ];

    protected function casts(): array
    {
        return [
            'aktif'        => 'boolean',
            'unggulan'     => 'boolean',
            'jalur_gratis' => 'boolean',
            'harga'        => 'decimal:2',
            'harga_coret'  => 'decimal:2',
        ];
    }

    public function jenisGelar()
    {
        return $this->belongsTo(JenisGelar::class, 'jenis_gelar_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'program_id');
    }

    public function semester()
    {
        return $this->hasMany(Semester::class, 'program_id')->orderBy('nomor');
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'program_id');
    }

    public function kuesioner()
    {
        return $this->hasMany(Kuesioner::class, 'program_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeUnggulan($query)
    {
        return $query->where('unggulan', true);
    }

    // ========== Computed attributes ==========

    public function getGratisAttribute(): bool
    {
        return (float)$this->harga == 0 || $this->jalur_gratis;
    }

    public function getAdaDiskonAttribute(): bool
    {
        return $this->harga_coret !== null && (float)$this->harga_coret > (float)$this->harga;
    }

    public function getPorsenDiskonAttribute(): int
    {
        if (!$this->ada_diskon) return 0;
        return (int) round((($this->harga_coret - $this->harga) / $this->harga_coret) * 100);
    }

    public function getJumlahPesertaAttribute(): int
    {
        return $this->pendaftaran()->whereIn('status', ['aktif', 'selesai'])->count();
    }

    public function getPenuhAttribute(): bool
    {
        if ($this->maks_peserta === 0) return false;
        return $this->jumlah_peserta >= $this->maks_peserta;
    }

    public function getTotalSesiAttribute(): int
    {
        return $this->semester()->withCount('sesiBelajar')->get()->sum('sesi_belajar_count');
    }
}
