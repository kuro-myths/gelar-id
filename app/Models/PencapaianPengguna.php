<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PencapaianPengguna extends Model
{
    use HasFactory;

    protected $table = 'pencapaian_pengguna';

    protected $fillable = [
        'pengguna_id', 'pencapaian_id', 'status',
        'bukti', 'catatan_pengguna', 'catatan_admin',
        'diverifikasi_oleh', 'diverifikasi_pada', 'diraih_pada',
    ];

    protected function casts(): array
    {
        return [
            'diverifikasi_pada' => 'datetime',
            'diraih_pada'       => 'datetime',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function pencapaian()
    {
        return $this->belongsTo(Pencapaian::class, 'pencapaian_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(Pengguna::class, 'diverifikasi_oleh');
    }

    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'menunggu'    => '⏳ Menunggu Verifikasi',
            'diverifikasi'=> '✅ Diraih',
            'ditolak'     => '❌ Ditolak',
            default       => $this->status,
        };
    }

    public function getWarnaStatusAttribute(): string
    {
        return match($this->status) {
            'menunggu'    => '#F59E0B',
            'diverifikasi'=> '#06d6a0',
            'ditolak'     => '#f72585',
            default       => '#94a3b8',
        };
    }
}
