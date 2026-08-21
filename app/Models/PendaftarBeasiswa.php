<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendaftarBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_beasiswa';

    protected $fillable = [
        'pengguna_id', 'beasiswa_id', 'program_id',
        'nomor_pendaftaran_beasiswa', 'status',
        'dokumen', 'surat_motivasi', 'catatan_admin',
        'diverifikasi_oleh', 'diverifikasi_pada', 'email_terkirim',
    ];

    protected function casts(): array
    {
        return [
            'dokumen'          => 'array',
            'diverifikasi_pada'=> 'datetime',
            'email_terkirim'   => 'boolean',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->nomor_pendaftaran_beasiswa = 'BSW-' . strtoupper(uniqid());
        });
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'beasiswa_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(Pengguna::class, 'diverifikasi_oleh');
    }

    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'menunggu'  => '⏳ Menunggu Review',
            'diproses'  => '🔍 Sedang Diproses',
            'diterima'  => '✅ Diterima',
            'ditolak'   => '❌ Ditolak',
            default     => $this->status,
        ];
    }

    public function getWarnaStatusAttribute(): string
    {
        return match($this->status) {
            'menunggu'  => '#F59E0B',
            'diproses'  => '#4361ee',
            'diterima'  => '#06d6a0',
            'ditolak'   => '#f72585',
            default     => '#94a3b8',
        ];
    }
}
