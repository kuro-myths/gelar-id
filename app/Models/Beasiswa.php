<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'syarat', 'pencapaian_wajib',
        'tipe_manfaat', 'nilai_manfaat', 'kuota', 'total_diterima',
        'buka_pada', 'tutup_pada', 'aktif',
    ];

    protected function casts(): array
    {
        return [
            'pencapaian_wajib' => 'array',
            'nilai_manfaat'    => 'decimal:2',
            'buka_pada'        => 'date',
            'tutup_pada'       => 'date',
            'aktif'            => 'boolean',
        ];
    }

    public function pendaftar()
    {
        return $this->hasMany(PendaftarBeasiswa::class, 'beasiswa_id');
    }

    public function pencapaianWajib()
    {
        if (empty($this->pencapaian_wajib)) return collect();
        return Pencapaian::whereIn('id', $this->pencapaian_wajib)->get();
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)
            ->where(function ($q) {
                $q->whereNull('tutup_pada')->orWhere('tutup_pada', '>=', now()->toDateString());
            });
    }

    public function getMasihBukaAttribute(): bool
    {
        if (!$this->aktif) return false;
        if ($this->tutup_pada && $this->tutup_pada->isPast()) return false;
        if ($this->buka_pada && $this->buka_pada->isFuture()) return false;
        return true;
    }

    public function getSisaKuotaAttribute(): int
    {
        if ($this->kuota === 0) return 999;
        return max(0, $this->kuota - $this->total_diterima);
    }

    public function getLabelManfaatAttribute(): string
    {
        return match($this->tipe_manfaat) {
            'penuh'   => '🆓 Beasiswa Penuh (100%)',
            'sebagian'=> '💰 Beasiswa Sebagian',
            'subsidi' => '🎟️ Subsidi Rp ' . number_format($this->nilai_manfaat, 0, ',', '.'),
            default   => $this->tipe_manfaat,
        };
    }
}
