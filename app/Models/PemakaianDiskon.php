<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemakaianDiskon extends Model
{
    protected $table = 'pemakaian_diskon';

    protected $fillable = [
        'diskon_id', 'pengguna_id', 'pendaftaran_id', 'nilai_potongan',
    ];

    protected function casts(): array
    {
        return ['nilai_potongan' => 'decimal:2'];
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}
