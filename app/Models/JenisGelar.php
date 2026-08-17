<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisGelar extends Model
{
    use HasFactory;

    protected $table = 'jenis_gelar';

    protected $fillable = [
        'kode', 'gelar_singkat', 'nama', 'kategori', 'deskripsi',
        'syarat', 'prospek_karir', 'durasi_bulan', 'sks_dibutuhkan',
        'jumlah_semester', 'keunggulan', 'mata_kuliah_inti',
        'ikon', 'warna', 'aktif', 'urutan',
    ];

    protected function casts(): array
    {
        return [
            'aktif'           => 'boolean',
            'durasi_bulan'    => 'integer',
            'sks_dibutuhkan'  => 'integer',
            'jumlah_semester' => 'integer',
            'urutan'          => 'integer',
            'keunggulan'      => 'array',
            'mata_kuliah_inti'=> 'array',
        ];
    }

    public function program()
    {
        return $this->hasMany(Program::class, 'jenis_gelar_id');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'jenis_gelar_id');
    }

    public function getLabelKategoriAttribute(): string
    {
        return match($this->kategori) {
            'sarjana' => 'Sarjana Virtual',
            'diploma' => 'Diploma Virtual',
            'vokasi'  => 'Vokasi Virtual',
            default   => $this->kategori,
        };
    }

    public function getDurasiTahunAttribute(): string
    {
        $tahun = intdiv($this->durasi_bulan, 12);
        $bulan = $this->durasi_bulan % 12;
        if ($tahun > 0 && $bulan > 0) return "{$tahun} Tahun {$bulan} Bulan";
        if ($tahun > 0) return "{$tahun} Tahun";
        return "{$bulan} Bulan";
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }
}
