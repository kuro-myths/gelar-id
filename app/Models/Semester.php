<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semester';

    protected $fillable = [
        'program_id', 'nomor', 'nama', 'deskripsi',
        'mata_kuliah', 'jumlah_sks', 'tanggal_mulai',
        'tanggal_selesai', 'aktif',
    ];

    protected function casts(): array
    {
        return [
            'mata_kuliah'    => 'array',
            'tanggal_mulai'  => 'date',
            'tanggal_selesai'=> 'date',
            'aktif'          => 'boolean',
        ];
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function sesiBelajar()
    {
        return $this->hasMany(SesiBelajar::class, 'semester_id')->orderBy('pertemuan_ke');
    }

    public function getStatusAttribute(): string
    {
        $now = now();
        if ($this->tanggal_mulai && $now->lt($this->tanggal_mulai)) return 'belum_mulai';
        if ($this->tanggal_selesai && $now->gt($this->tanggal_selesai)) return 'selesai';
        return 'berjalan';
    }

    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            'belum_mulai' => 'Belum Mulai',
            'berjalan'    => 'Sedang Berjalan',
            'selesai'     => 'Selesai',
            default       => '-',
        };
    }
}
