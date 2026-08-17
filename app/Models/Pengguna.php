<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama', 'email', 'nama_pengguna', 'nim', 'password',
        'peran', 'avatar', 'telepon', 'alamat', 'institusi', 'aktif',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'aktif'             => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->peran === 'admin';
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'pengguna_id');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'pengguna_id');
    }

    public function kelasDiajar()
    {
        return $this->hasMany(\App\Models\Kelas::class, 'pengajar_id');
    }

    public function pesertaKelas()
    {
        return $this->hasMany(\App\Models\PesertaKelas::class, 'pengguna_id');
    }

    public function isPengajar(): bool
    {
        return $this->peran === 'pengajar';
    }

}
