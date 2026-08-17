<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'pengguna_id', 'program_id', 'nomor_pendaftaran', 'status',
        'jumlah_bayar', 'terdaftar_pada', 'selesai_pada', 'kemajuan', 'catatan',
    ];

    protected function casts(): array
    {
        return [
            'terdaftar_pada' => 'datetime',
            'selesai_pada'   => 'datetime',
            'jumlah_bayar'   => 'decimal:2',
            'kemajuan'       => 'integer',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class, 'pendaftaran_id');
    }

    public function kemajuanAkademik()
    {
        return $this->hasMany(KemajuanAkademik::class, 'pendaftaran_id');
    }

    public function hitungKemajuan(): int
    {
        $totalSesi = $this->program->total_sesi;
        if ($totalSesi === 0) return 0;
        $selesai = $this->kemajuanAkademik()->where('selesai', true)->count();
        return (int) round(($selesai / $totalSesi) * 100);
    }

    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'menunggu' => 'Menunggu',
            'aktif'    => 'Aktif',
            'selesai'  => 'Selesai',
            'batal'    => 'Dibatalkan',
            default    => $this->status,
        };
    }

    public function getWarnaStatusAttribute(): string
    {
        return match($this->status) {
            'menunggu' => 'yellow',
            'aktif'    => 'blue',
            'selesai'  => 'green',
            'batal'    => 'red',
            default    => 'gray',
        };
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($p) {
            $p->nomor_pendaftaran = 'DFT-' . strtoupper(uniqid());
        });
    }
}

