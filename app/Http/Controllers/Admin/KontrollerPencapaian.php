<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PencapaianDiraih;
use App\Models\Pencapaian;
use App\Models\PencapaianPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class KontrollerPencapaian extends Controller
{
    // ===== DAFTAR PENCAPAIAN (master) =====
    public function daftar()
    {
        $pencapaian = Pencapaian::withCount('penggunaYangRaih')
            ->orderBy('urutan')->get();
        return view('admin.pencapaian.daftar', compact('pencapaian'));
    }

    public function buat()
    {
        return view('admin.pencapaian.buat');
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama'                      => 'required|string|max:255',
            'deskripsi'                 => 'required|string',
            'ikon'                      => 'required|string|max:10',
            'warna'                     => 'required|string',
            'kategori'                  => 'required|in:akademik,kehadiran,kuesioner,game,sosial,khusus',
            'tipe_syarat'               => 'required|in:otomatis,manual,upload',
            'poin'                      => 'required|integer|min:0',
            'adalah_prasyarat_beasiswa' => 'boolean',
            'urutan'                    => 'required|integer|min:0',
        ]);

        $data['slug']                      = Str::slug($data['nama']);
        $data['adalah_prasyarat_beasiswa'] = $request->boolean('adalah_prasyarat_beasiswa');
        $data['aktif']                     = true;

        // Syarat opsional sebagai JSON
        if ($request->filled('syarat_tipe')) {
            $data['syarat'] = [
                'tipe'  => $request->syarat_tipe,
                'nilai' => $request->syarat_nilai,
                'keterangan' => $request->syarat_keterangan,
            ];
        }

        Pencapaian::create($data);
        return redirect('/admin/pencapaian')->with('sukses', 'Pencapaian berhasil dibuat.');
    }

    public function edit(Pencapaian $pencapaian)
    {
        return view('admin.pencapaian.edit', compact('pencapaian'));
    }

    public function perbarui(Request $request, Pencapaian $pencapaian)
    {
        $data = $request->validate([
            'nama'                      => 'required|string|max:255',
            'deskripsi'                 => 'required|string',
            'ikon'                      => 'required|string|max:10',
            'warna'                     => 'required|string',
            'kategori'                  => 'required|in:akademik,kehadiran,kuesioner,game,sosial,khusus',
            'tipe_syarat'               => 'required|in:otomatis,manual,upload',
            'poin'                      => 'required|integer|min:0',
            'adalah_prasyarat_beasiswa' => 'boolean',
            'urutan'                    => 'required|integer|min:0',
        ]);

        $data['adalah_prasyarat_beasiswa'] = $request->boolean('adalah_prasyarat_beasiswa');
        $data['aktif']                     = $request->boolean('aktif');

        if ($request->filled('syarat_tipe')) {
            $data['syarat'] = [
                'tipe'       => $request->syarat_tipe,
                'nilai'      => $request->syarat_nilai,
                'keterangan' => $request->syarat_keterangan,
            ];
        }

        $pencapaian->update($data);
        return redirect('/admin/pencapaian')->with('sukses', 'Pencapaian diperbarui.');
    }

    public function hapus(Pencapaian $pencapaian)
    {
        $pencapaian->delete();
        return back()->with('sukses', 'Pencapaian dihapus.');
    }

    // ===== VERIFIKASI KLAIM PENGGUNA =====
    public function klaim()
    {
        $klaim = PencapaianPengguna::with(['pengguna', 'pencapaian'])
            ->whereIn('status', ['menunggu'])
            ->latest()->paginate(20);
        return view('admin.pencapaian.klaim', compact('klaim'));
    }

    public function verifikasi(Request $request, PencapaianPengguna $klaimPencapaian)
    {
        $request->validate([
            'status'        => 'required|in:diverifikasi,ditolak',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $klaimPencapaian->update([
            'status'            => $request->status,
            'catatan_admin'     => $request->catatan_admin,
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_pada' => now(),
            'diraih_pada'       => $request->status === 'diverifikasi' ? now() : null,
        ]);

        // Kirim email notifikasi jika diterima
        if ($request->status === 'diverifikasi') {
            try {
                Mail::to($klaimPencapaian->pengguna->email)
                    ->send(new PencapaianDiraih($klaimPencapaian));
            } catch (\Exception $e) {
                // Log error tapi jangan gagalkan request
                \Log::warning('Gagal kirim email pencapaian: ' . $e->getMessage());
            }
        }

        $pesan = $request->status === 'diverifikasi'
            ? '✅ Pencapaian diverifikasi dan pengguna diberitahu via email.'
            : '❌ Klaim pencapaian ditolak.';

        return back()->with('sukses', $pesan);
    }
}
