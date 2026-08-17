<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AnalisisMinat extends Model {
    protected $table = 'analisis_minat';
    protected $fillable = [
        'pengguna_id','sesi_id','jawaban_kuis','hasil_skor',
        'jenis_gelar_rekomendasi_id','program_rekomendasi_id',
        'alasan_rekomendasi','skor_tertinggi',
    ];
    protected function casts(): array {
        return ['jawaban_kuis'=>'array','hasil_skor'=>'array'];
    }
    public function pengguna() { return $this->belongsTo(Pengguna::class,'pengguna_id'); }
    public function jenisGelarRekomendasi() { return $this->belongsTo(JenisGelar::class,'jenis_gelar_rekomendasi_id'); }
    public function programRekomendasi() { return $this->belongsTo(Program::class,'program_rekomendasi_id'); }
}
