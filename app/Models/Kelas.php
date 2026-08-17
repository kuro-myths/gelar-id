<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'tingkat', 'kategori', 'ikon',
        'warna', 'label_badge', 'harga', 'jalur_gratis', 'durasi_jam',
        'jumlah_sesi', 'aktif', 'unggulan', 'kurikulum', 'yang_dipelajari', 'pengajar_id',
    ];

    protected function casts(): array
    {
        return [
            'aktif'          => 'boolean',
            'unggulan'       => 'boolean',
            'jalur_gratis'   => 'boolean',
            'harga'          => 'decimal:2',
            'kurikulum'      => 'array',
            'yang_dipelajari'=> 'array',
        ];
    }

    public function pengajar()
    {
        return $this->belongsTo(Pengguna::class, 'pengajar_id');
    }

    public function peserta()
    {
        return $this->hasMany(PesertaKelas::class, 'kelas_id');
    }

    public function getLabelTingkatAttribute(): string
    {
        return match($this->tingkat) {
            'sd'   => 'SD / Setara',
            'smp'  => 'SMP / Setara',
            'sma'  => 'SMA / Setara',
            'umum' => 'Umum / Semua Usia',
            default => $this->tingkat,
        };
    }

    public function getWarnaLabelTingkatAttribute(): string
    {
        return match($this->tingkat) {
            'sd'   => '#EF4444',
            'smp'  => '#F59E0B',
            'sma'  => '#4361ee',
            'umum' => '#06d6a0',
            default => '#6366F1',
        };
    }

    public function getGratisAttribute(): bool
    {
        return (float)$this->harga == 0 || $this->jalur_gratis;
    }

    public function getJumlahPesertaAttribute(): int
    {
        return $this->peserta()->whereIn('status', ['aktif', 'selesai'])->count();
    }

    public function scopeAktif($q)
    {
        return $q->where('aktif', true);
    }

    public function scopeUnggulan($q)
    {
        return $q->where('unggulan', true);
    }
}
