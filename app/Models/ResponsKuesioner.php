<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponsKuesioner extends Model
{
    protected $table = 'respons_kuesioner';

    protected $fillable = [
        'kuesioner_id', 'pengguna_id', 'nilai_total',
        'mulai_pada', 'selesai_pada', 'selesai',
    ];

    protected function casts(): array
    {
        return [
            'mulai_pada'  => 'datetime',
            'selesai_pada'=> 'datetime',
            'selesai'     => 'boolean',
            'nilai_total' => 'decimal:2',
        ];
    }

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'kuesioner_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'respons_id');
    }
}
