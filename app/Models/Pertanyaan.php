<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $fillable = [
        'kuesioner_id', 'urutan', 'teks_pertanyaan',
        'tipe', 'opsi', 'wajib', 'bobot',
    ];

    protected function casts(): array
    {
        return [
            'opsi'   => 'array',
            'wajib'  => 'boolean',
            'bobot'  => 'integer',
            'urutan' => 'integer',
        ];
    }

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'kuesioner_id');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'pertanyaan_id');
    }

    public function getLabelTipeAttribute(): string
    {
        return match($this->tipe) {
            'pilihan_ganda' => 'Pilihan Ganda',
            'esai'          => 'Esai',
            'benar_salah'   => 'Benar/Salah',
            'skala'         => 'Skala (1-5)',
            'centang'       => 'Centang',
            default         => $this->tipe,
        ];
    }
}
