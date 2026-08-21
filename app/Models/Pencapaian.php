<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pencapaian extends Model
{
    use HasFactory;

    protected $table = 'pencapaian';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'ikon', 'warna',
        'kategori', 'tipe_syarat', 'syarat', 'poin',
        'adalah_prasyarat_beasiswa', 'aktif', 'urutan',
    ];

    protected function casts(): array
    {
        return [
            'syarat'                    => 'array',
            'adalah_prasyarat_beasiswa' => 'boolean',
            'aktif'                     => 'boolean',
        ];
    }

    public function penggunaYangRaih()
    {
        return $this->hasMany(PencapaianPengguna::class, 'pencapaian_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }

    public function getLabelKategoriAttribute(): string
    {
        return match($this->kategori) {
            'akademik'  => '📚 Akademik',
            'kehadiran' => '📅 Kehadiran',
            'kuesioner' => '📋 Kuesioner',
            'game'      => '🎮 Game & Tantangan',
            'sosial'    => '🤝 Sosial',
            'khusus'    => '⭐ Khusus',
            default     => $this->kategori,
        };
    }

    public function getLabelTipeSyaratAttribute(): string
    {
        return match($this->tipe_syarat) {
            'otomatis' => '⚡ Otomatis',
            'manual'   => '👤 Verifikasi Admin',
            'upload'   => '📤 Upload Bukti',
            default    => $this->tipe_syarat,
        };
    }
}
