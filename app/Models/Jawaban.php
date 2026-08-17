<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    protected $fillable = ['respons_id', 'pertanyaan_id', 'jawaban', 'nilai'];

    protected function casts(): array
    {
        return ['nilai' => 'decimal:2'];
    }

    public function respons()
    {
        return $this->belongsTo(ResponsKuesioner::class, 'respons_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }
}
