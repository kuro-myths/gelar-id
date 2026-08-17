<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PersetujuanPendaftaran extends Model {
    protected $table = 'persetujuan_pendaftaran';
    protected $fillable = [
        'pendaftaran_id','tipe_wali','nama_wali','hubungan_wali',
        'telepon_wali','email_wali','pernyataan_mandiri',
        'setuju_syarat','setuju_independen','setuju_swadaya',
        'tanda_tangan_digital','disetujui_pada','alamat_ip',
    ];
    protected function casts(): array {
        return [
            'setuju_syarat'=>'boolean',
            'setuju_independen'=>'boolean', 
            'setuju_swadaya'=>'boolean',
            'disetujui_pada'=>'datetime',
        ];
    }
    public function pendaftaran() { return $this->belongsTo(Pendaftaran::class,'pendaftaran_id'); }
    public function getLabelTipeWaliAttribute(): string {
        return match($this->tipe_wali) {
            'orang_tua' => '👨‍👩‍👧 Orang Tua',
            'wali'      => '👤 Wali/Keluarga',
            'mandiri'   => '🦅 Mandiri (Tidak Punya Wali)',
            default     => $this->tipe_wali,
        };
    }
}
