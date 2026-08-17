<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';

    protected $fillable = [
        'sesi_belajar_id', 'program_id', 'dibuat_oleh', 'judul',
        'deskripsi', 'id_ruangan', 'kata_sandi', 'tautan_gabung',
        'platform', 'dijadwalkan_pada', 'durasi_menit', 'maks_peserta',
        'status', 'catatan', 'rekam_otomatis', 'tautan_rekaman',
    ];

    protected function casts(): array
    {
        return [
            'dijadwalkan_pada' => 'datetime',
            'rekam_otomatis'   => 'boolean',
        ];
    }

    public function sesiBelajar()
    {
        return $this->belongsTo(SesiBelajar::class, 'sesi_belajar_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function pembuat()
    {
        return $this->belongsTo(Pengguna::class, 'dibuat_oleh');
    }

    public function peserta()
    {
        return $this->hasMany(PesertaPertemuan::class, 'pertemuan_id');
    }

    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'terjadwal'   => '📅 Terjadwal',
            'berlangsung' => '🔴 Berlangsung',
            'selesai'     => '✅ Selesai',
            'batal'       => '❌ Dibatalkan',
            default       => $this->status,
        };
    }

    public function getWarnaStatusAttribute(): string
    {
        return match($this->status) {
            'terjadwal'   => 'blue',
            'berlangsung' => 'red',
            'selesai'     => 'green',
            'batal'       => 'gray',
            default       => 'gray',
        };
    }

    public function getLabelPlatformAttribute(): string
    {
        return match($this->platform) {
            'zoom'     => '🎥 Zoom',
            'meet'     => '📹 Google Meet',
            'teams'    => '💼 MS Teams',
            'internal' => '🏠 Internal',
            default    => $this->platform,
        };
    }

    public function getTautanGabungLengkapAttribute(): string
    {
        if ($this->tautan_gabung) return $this->tautan_gabung;
        return url('/pengguna/pertemuan/' . $this->id_ruangan . '/gabung');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($p) {
            if (empty($p->id_ruangan)) {
                $p->id_ruangan = strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));
            }
        });
    }
}

