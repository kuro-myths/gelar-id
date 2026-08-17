<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kuesioner extends Model
{
    use HasFactory;

    protected $table = 'kuesioner';

    protected $fillable = [
        'program_id', 'sesi_belajar_id', 'judul', 'deskripsi',
        'tipe', 'dibuka_pada', 'ditutup_pada', 'batas_waktu_menit',
        'wajib', 'acak_soal', 'aktif',
    ];

    protected function casts(): array
    {
        return [
            'dibuka_pada'  => 'datetime',
            'ditutup_pada' => 'datetime',
            'wajib'        => 'boolean',
            'acak_soal'    => 'boolean',
            'aktif'        => 'boolean',
        ];
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function sesiBelajar()
    {
        return $this->belongsTo(SesiBelajar::class, 'sesi_belajar_id');
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'kuesioner_id')->orderBy('urutan');
    }

    public function respons()
    {
        return $this->hasMany(ResponsKuesioner::class, 'kuesioner_id');
    }

    public function sudahDiisi(int $penggunaId): bool
    {
        return $this->respons()->where('pengguna_id', $penggunaId)->where('selesai', true)->exists();
    }

    public function getTotalBobot(): int
    {
        return $this->pertanyaan()->sum('bobot');
    }

    public function getLabelTipeAttribute(): string
    {
        return match($this->tipe) {
            'pra_kelas'  => '📋 Pra-Kelas',
            'pasca_kelas'=> '📝 Pasca-Kelas',
            'kepuasan'   => '😊 Kepuasan',
            'ujian'      => '📚 Ujian',
            'umum'       => '📄 Umum',
            default      => $this->tipe,
        };
    }

    public function getStatusAttribute(): string
    {
        if (!$this->aktif) return 'nonaktif';
        $now = now();
        if ($this->dibuka_pada && $now->lt($this->dibuka_pada)) return 'belum_buka';
        if ($this->ditutup_pada && $now->gt($this->ditutup_pada)) return 'ditutup';
        return 'buka';
    }
}

