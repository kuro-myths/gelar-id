<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diskon extends Model
{
    use HasFactory;

    protected $table = 'diskon';

    protected $fillable = [
        'kode', 'nama', 'deskripsi', 'tipe', 'nilai',
        'maks_penggunaan', 'total_digunakan', 'min_pembelian',
        'berlaku_mulai', 'berlaku_hingga', 'aktif', 'program_ids',
    ];

    protected function casts(): array
    {
        return [
            'berlaku_mulai'  => 'datetime',
            'berlaku_hingga' => 'datetime',
            'aktif'          => 'boolean',
            'nilai'          => 'decimal:2',
            'min_pembelian'  => 'decimal:2',
            'program_ids'    => 'array',
        ];
    }

    public function pemakaian()
    {
        return $this->hasMany(PemakaianDiskon::class, 'diskon_id');
    }

    public function getStatusAttribute(): string
    {
        if (!$this->aktif) return 'nonaktif';
        $now = now();
        if ($this->berlaku_mulai && $now->lt($this->berlaku_mulai)) return 'belum_aktif';
        if ($this->berlaku_hingga && $now->gt($this->berlaku_hingga)) return 'kedaluwarsa';
        if ($this->maks_penggunaan > 0 && $this->total_digunakan >= $this->maks_penggunaan) return 'habis';
        return 'aktif';
    }

    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'aktif'        => '✅ Aktif',
            'nonaktif'     => '❌ Nonaktif',
            'belum_aktif'  => '⏳ Belum Aktif',
            'kedaluwarsa'  => '🔒 Kedaluwarsa',
            'habis'        => '🚫 Habis',
            default        => $this->status,
        };
    }

    public function getLabelTipeAttribute(): string
    {
        return match($this->tipe) {
            'persen'   => 'Diskon %',
            'nominal'  => 'Potongan Rp',
            'gratis'   => '🆓 Gratis',
            default    => $this->tipe,
        };
    }

    public function hitungPotongan(float $harga): float
    {
        return match($this->tipe) {
            'persen'  => $harga * ($this->nilai / 100),
            'nominal' => min($this->nilai, $harga),
            'gratis'  => $harga,
            default   => 0,
        };
    }

    public function hitungHargaAkhir(float $harga): float
    {
        return max(0, $harga - $this->hitungPotongan($harga));
    }

    public function berlakuUntukProgram(int $programId): bool
    {
        if (empty($this->program_ids)) return true;
        return in_array($programId, $this->program_ids);
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)
            ->where(fn($q) => $q->whereNull('berlaku_mulai')->orWhere('berlaku_mulai', '<=', now()))
            ->where(fn($q) => $q->whereNull('berlaku_hingga')->orWhere('berlaku_hingga', '>=', now()));
    }
}
