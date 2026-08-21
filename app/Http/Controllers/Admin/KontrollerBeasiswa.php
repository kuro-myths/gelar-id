<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BeasiswaDiproses;
use App\Models\Beasiswa;
use App\Models\Pencapaian;
use App\Models\PendaftarBeasiswa;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class KontrollerBeasiswa extends Controller
{
    // ===== MASTER BEASISWA =====
    public function daftar()
    {
        $beasiswa = Beasiswa::withCount('pendaftar')->latest()->paginate(15);
        return view('admin.beasiswa.daftar', compact('beasiswa'));
    }

    public function buat()
    {
        $pencapaian = Pencapaian::aktif()->where('adalah_prasyarat_beasiswa', true)->get();
        return view('admin.beasiswa.buat', compact('pencapaian'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama'                => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'syarat'              => 'nullable|string',
            'tipe_manfaat'        => 'required|in:penuh,sebagian,subsidi',
            'nilai_manfaat'       => 'required|numeric|min:0',
            'kuota'               => 'required|integer|min:0',
            'buka_pada'           => 'nullable|date',
            'tutup_pada'          => 'nullable|date|after_or_equal:buka_pada',
            'pencapaian_wajib'    => 'nullable|array',
            'pencapaian_wajib.*'  => 'exists:pencapaian,id',
        ]);

        $data['slug']  = Str::slug($data['nama']);
        $data['aktif'] = true;

        Beasiswa::create($data);
        return redirect('/admin/beasiswa')->with('sukses', 'Beasiswa berhasil dibuat.');
    }

    public function edit(Beasiswa $beasiswa)
    {
        $pencapaian = Pencapaian::aktif()->where('adalah_prasyarat_beasiswa', true)->get();
        return view('admin.beasiswa.edit', compact('beasiswa', 'pencapaian'));
    }

    public function perbarui(Request $request, Beasiswa $beasiswa)
    {
        $data = $request->validate([
            'nama'                => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'syarat'              => 'nullable|string',
            'tipe_manfaat'        => 'required|in:penuh,sebagian,subsidi',
            'nilai_manfaat'       => 'required|numeric|min:0',
            'kuota'               => 'required|integer|min:0',
            'buka_pada'           => 'nullable|date',
            'tutup_pada'          => 'nullable|date',
            'pencapaian_wajib'    => 'nullable|array',
            'pencapaian_wajib.*'  => 'exists:pencapaian,id',
        ]);

        $data['aktif'] = $request->boolean('aktif');
        $beasiswa->update($data);
        return redirect('/admin/beasiswa')->with('sukses', 'Beasiswa diperbarui.');
    }

    public function hapus(Beasiswa $beasiswa)
    {
        $beasiswa->delete();
        return back()->with('sukses', 'Beasiswa dihapus.');
    }

    // ===== PENDAFTAR BEASISWA =====
    public function pendaftar(Beasiswa $beasiswa)
    {
        $pendaftar = $beasiswa->pendaftar()
            ->with(['pengguna', 'program.jenisGelar'])
            ->latest()->paginate(20);
        return view('admin.beasiswa.pendaftar', compact('beasiswa', 'pendaftar'));
    }

    public function detailPendaftar(PendaftarBeasiswa $pendaftarBeasiswa)
    {
        $pendaftarBeasiswa->load(['pengguna.pencapaianDiraih.pencapaian', 'beasiswa', 'program.jenisGelar']);
        return view('admin.beasiswa.detail-pendaftar', compact('pendaftarBeasiswa'));
    }

    public function prosesVerifikasi(Request $request, PendaftarBeasiswa $pendaftarBeasiswa)
    {
        $request->validate([
            'status'        => 'required|in:diproses,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $statusLama = $pendaftarBeasiswa->status;
        $statusBaru = $request->status;

        $pendaftarBeasiswa->update([
            'status'            => $statusBaru,
            'catatan_admin'     => $request->catatan_admin,
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_pada' => now(),
        ]);

        // Update kuota jika diterima
        if ($statusBaru === 'diterima' && $statusLama !== 'diterima') {
            $pendaftarBeasiswa->beasiswa->increment('total_diterima');
        }

        // Kirim email
        if (in_array($statusBaru, ['diterima', 'ditolak', 'diproses'])) {
            try {
                Mail::to($pendaftarBeasiswa->pengguna->email)
                    ->send(new BeasiswaDiproses($pendaftarBeasiswa, $statusBaru));
                $pendaftarBeasiswa->update(['email_terkirim' => true]);
            } catch (\Exception $e) {
                \Log::warning('Gagal kirim email beasiswa: ' . $e->getMessage());
            }
        }

        $labelStatus = [
            'diproses' => '🔍 sedang diproses',
            'diterima' => '✅ diterima',
            'ditolak'  => '❌ ditolak',
        ];

        return back()->with('sukses',
            'Status beasiswa diubah menjadi ' . ($labelStatus[$statusBaru] ?? $statusBaru) . '. Email notifikasi terkirim.'
        );
    }
}
